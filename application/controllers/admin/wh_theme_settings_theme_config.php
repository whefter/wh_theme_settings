<?php
/**
 * This file is part of the OXID eShop module 'wh_theme_settings'.
 *
 * 'wh_theme_settings' is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * 'wh_theme_settings' is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with 'wh_theme_settings'.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Extention of Theme_Config. Adds _loadMetadataConfVars() (copied from Module_Config, slight
 * modification to use getShopConfVar() instead of getConfigParam; else params from the currently active
 * module may be accessed instead of the currently viewed one) and alters render() to call it 
 * instead of loadConfVars() (only one line, rest copied from Theme_Config).
 * 
 * @author William Hefter <william@whefter.de>
 */
class wh_theme_settings_theme_config extends wh_theme_settings_theme_config_parent
{
    /**
     * Executes parent method parent::render(), creates deliveryset category tree,
     * passes data to Smarty engine and returns name of template file "theme_config.tpl".
     *
     * @return string
     */
    public function render()
    {
        $myConfig  = $this->getConfig();

        $sTheme  = $this->_sTheme = $this->getEditObjectId();
        $sShopId = $myConfig->getShopId();

        if (!isset( $sTheme ) ) {
            $sTheme = $this->_sTheme = $this->getConfig()->getConfigParam('sTheme');
        }

        $oTheme = oxNew('oxTheme');
        if ($oTheme->load($sTheme)) {
            $this->_aViewData["oTheme"] =  $oTheme;

            try {
                $aDbVariables = $this->_loadMetadataConfVars($oTheme->getInfo("settings"));
                
                $this->_aViewData["var_constraints"] = $aDbVariables['constraints'];
                $this->_aViewData["var_grouping"]    = $aDbVariables['grouping'];
                foreach ($this->_aConfParams as $sType => $sParam) {
                    $this->_aViewData[$sParam] = $aDbVariables['vars'][$sType];
                }
            } catch (oxException $oEx) {
                oxRegistry::get("oxUtilsView")->addErrorToDisplay( $oEx );
                $oEx->debugOut();
            }
        } else {
            oxRegistry::get("oxUtilsView")->addErrorToDisplay( oxNew( "oxException", 'EXCEPTION_THEME_NOT_LOADED') );
        }
        return 'theme_config.tpl';
    }

    /**
     * Load and parse config vars from metadata.
     * Return value is a map:
     *      'vars'        => config variable values as array[type][name] = value
     *      'constraints' => constraints list as array[name] = constraint
     *      'grouping'    => grouping info as array[name] = grouping
     *
     * @param array $aThemeSettings settings array from theme metadata
     *
     * @return array
     */
    public function _loadMetadataConfVars($aThemeSettings)
    {
        $oConfig  = $this->getConfig();

        $aConfVars = array(
            "bool"    => array(),
            "str"     => array(),
            "arr"     => array(),
            "aarr"    => array(),
            "select"  => array(),
        );
        $aVarConstraints = array();
        $aGrouping       = array();
        
        $aDbVariables = $this->loadConfVars($oConfig->getShopId(), $this->_getModuleForConfigVars());
        
        if ( is_array($aThemeSettings) ) {

            foreach ( $aThemeSettings as $aValue ) {

                $sName       = $aValue["name"];
                $sType       = $aValue["type"];
                $sValue = null;
                
                // Use getShopConfVar() instead of getConfigParam() to ensure we are fetching from the correct them.
                // If two themes have a variable with the same name, getConfigParam() might return the wrong one.
                if ( is_null($oConfig->getShopConfVar($sName, $oConfig->getShopId(), $this->_getModuleForConfigVars())) ) {
                    switch ($aValue["type"]){
                        case "arr":
                            $sValue = $this->_arrayToMultiline( @unserialize( $aValue["value"] ) );
                            break;
                        case "aarr":
                            $sValue = $this->_aarrayToMultiline( @unserialize( $aValue["value"] ) );
                            break;
                    }
                    $sValue = getStr()->htmlentities( $sValue );
                } else {
                    $sValue = $aDbVariables['vars'][$sType][$sName];
                }
                
                $sGroup      = $aValue["group"];

                $sConstraints = "";
                if ( $aValue["constraints"] ) {
                    $sConstraints = $aValue["constraints"];
                } elseif ( $aValue["constrains"] ) {
                    $sConstraints = $aValue["constrains"];
                }

                $aConfVars[$sType][$sName] = $sValue;
                $aVarConstraints[$sName]   = $this->_parseConstraint( $sType, $sConstraints );
                if ($sGroup) {
                    if (!isset($aGrouping[$sGroup])) {
                        $aGrouping[$sGroup] = array($sName=>$sType);
                    } else {
                        $aGrouping[$sGroup][$sName] = $sType;
                    }
                }
            }
        }

        return array(
            'vars'        => $aConfVars,
            'constraints' => $aVarConstraints,
            'grouping'    => $aGrouping,
        );
    }
}
