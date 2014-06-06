<?php
/**
 * @author      William Hefter <william@whefter.de>
 * @link        http://www.whefter.de
 */
 
$aModule = array(
    'id'          => 'wh_theme_settings',
    
    'title'       => 'Theme settings',
    
    'description' =>  array(
        'de' => 'Ermöglicht das bequeme Konfigurieren vom Theme-Config-Optionen über den "settings"-Abschnitt der Metadata-Datei, wie auch bei Modulen.',
        'en' => 'Enables easy configuration of theme config settings through the "settings" section in the theme metadata file, just like modules.',
    ),
    
    'version'     => '1.0.0',
    
    'url'         => 'http://www.whefter.de',
    
    'email'       => 'william@whefter.',
    
    'author'      => 'William Hefter',
    
    'extend'      => array(
        'oxtheme'                                   => 'wh/wh_theme_settings/core/wh_theme_settings_oxtheme',
        'theme_config'                              => 'wh/wh_theme_settings/application/controllers/admin/wh_theme_settings_theme_config',
    ),
    
    'files'      => array(
        'oxthemeinstaller'                          => 'wh/wh_theme_settings/core/oxthemeinstaller.php',
    ),
    
    'blocks' => array(
    ),
    
    'templates' => array(
    ),
    
    'settings' => array(
    ),
);