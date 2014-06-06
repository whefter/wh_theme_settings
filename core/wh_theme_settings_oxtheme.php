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
 * Replaces oxTheme's activate() method with one making use of oxThemeInstaller.
 *
 * @author William Hefter <william@whefter.de>
 */
class wh_theme_settings_oxtheme extends wh_theme_settings_oxtheme_parent
{
    /**
     * Set theme as active
     *
     * @return null
     */
    public function activate()
    {
        $sError = $this->checkForActivationErrors();
        if ($sError) {
            throw oxNew( "oxException", $sError );
        }
        
        $oThemeInstaller = oxNew( 'oxThemeInstaller' );

        return $oThemeInstaller->activate( $this );
    }
}

