##wh_theme_settings

OXID module enabling the use of a "settings" section in theme metadata files (theme.php in the theme's root folder).

The general idea is to make it easier to manage a theme's settings during development instead of adding them to the database manually.

The behaviour and syntax is identical to that of modules.

Syntax example for the "azure" module:

```php
// Settings section in theme.php for the 'azure' OXID eShop theme
'settings' => array(
    array('group' => 'images',          'name' => 'sManufacturerIconsize',          'type' => 'str',    'constraints' => '',                    'value' => '100*100'),
    array('group' => 'images',          'name' => 'sCatIconsize',                   'type' => 'str',    'constraints' => '',                    'value' => '168*100'),
    array('group' => 'images',          'name' => 'sCatPromotionsize',              'type' => 'str',    'constraints' => '',                    'value' => '370*107'),
    array('group' => 'images',          'name' => 'sIconsize',                      'type' => 'str',    'constraints' => '',                    'value' => '87*87'),
    array('group' => 'images',          'name' => 'sThumbnailsize',                 'type' => 'str',    'constraints' => '',                    'value' => '185*150'),
    array('group' => 'images',          'name' => 'sCatThumbnailsize',              'type' => 'str',    'constraints' => '',                    'value' => '748*150'),
    array('group' => 'images',          'name' => 'sZoomImageSize',                 'type' => 'str',    'constraints' => '',                    'value' => '665*665'),
    array('group' => 'images',          'name' => 'aDetailImageSizes',              'type' => 'aarr',   'constraints' => '',                    'value' => array(
                                                                                                                                                                'oxpic1' => '380*340',
                                                                                                                                                                'oxpic2' => '380*340',
                                                                                                                                                                'oxpic3' => '380*340',
                                                                                                                                                                'oxpic4' => '380*340',
                                                                                                                                                                'oxpic5' => '380*340',
                                                                                                                                                                'oxpic6' => '380*340',
                                                                                                                                                                'oxpic7' => '380*340',
                                                                                                                                                                'oxpic8' => '380*340',
                                                                                                                                                                'oxpic9' => '380*340',
                                                                                                                                                                'oxpic10' => '380*340',
                                                                                                                                                                'oxpic11' => '380*340',
                                                                                                                                                                'oxpic12' => '380*340',
                                                                                                                                                            )
    ),
    array('group' => 'features',        'name' => 'bl_showCompareList',             'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'features',        'name' => 'bl_showListmania',               'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'features',        'name' => 'bl_showWishlist',                'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'features',        'name' => 'bl_showVouchers',                'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'features',        'name' => 'bl_showGiftWrapping',            'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'display',         'name' => 'blShowBirthdayFields',           'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'display',         'name' => 'iTopNaviCatCount',               'type' => 'str',    'constraints' => '',                    'value' => '4'),
    array('group' => 'display',         'name' => 'sDefaultListDisplayType',        'type' => 'select', 'constraints' => 'infogrid|line|grid',  'value' => 'infogrid'),
    array('group' => 'display',         'name' => 'sStartPageListDisplayType',      'type' => 'select', 'constraints' => 'infogrid|line|grid',  'value' => 'infogrid'),
    array('group' => 'display',         'name' => 'blShowListDisplayType',          'type' => 'bool',   'constraints' => '',                    'value' => '1'),
    array('group' => 'display',         'name' => 'iNewBasketItemMessage',          'type' => 'select', 'constraints' => '0|1|2|3',             'value' => '1'),
    array('group' => 'display',         'name' => 'aNrofCatArticles',               'type' => 'arr',    'constraints' => '',                    'value' => array('10', '20', '50', '100')),
    array('group' => 'display',         'name' => 'aNrofCatArticlesInGrid',         'type' => 'arr',    'constraints' => '',                    'value' => array('12', '16', '24', '32')),
),
```
