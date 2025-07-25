<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit65474ceea10d460983368213200b2b50
{
    public static $prefixLengthsPsr4 = array (
        'w' => 
        array (
            'wirdwird\\Filters\\' => 17,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'wirdwird\\Filters\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/..' . '/getkirby/composer-installer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Kirby\\ComposerInstaller\\CmsInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/CmsInstaller.php',
        'Kirby\\ComposerInstaller\\Installer' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Installer.php',
        'Kirby\\ComposerInstaller\\Plugin' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/Plugin.php',
        'Kirby\\ComposerInstaller\\PluginInstaller' => __DIR__ . '/..' . '/getkirby/composer-installer/src/ComposerInstaller/PluginInstaller.php',
        'wirdwird\\Filters\\FieldFilters\\BooleanFieldFilter' => __DIR__ . '/../..' . '/src/FieldFilters/BooleanFieldFilter.php',
        'wirdwird\\Filters\\FieldFilters\\DateFieldFilter' => __DIR__ . '/../..' . '/src/FieldFilters/DateFieldFilter.php',
        'wirdwird\\Filters\\FieldFilters\\FieldFilterFactory' => __DIR__ . '/../..' . '/src/FieldFilters/FieldFilterFactory.php',
        'wirdwird\\Filters\\FieldFilters\\ListFieldFilter' => __DIR__ . '/../..' . '/src/FieldFilters/ListFieldFilter.php',
        'wirdwird\\Filters\\FieldFilters\\NumericFieldFilter' => __DIR__ . '/../..' . '/src/FieldFilters/NumericFieldFilter.php',
        'wirdwird\\Filters\\FieldFilters\\StringFieldFilter' => __DIR__ . '/../..' . '/src/FieldFilters/StringFieldFilter.php',
        'wirdwird\\Filters\\FilterManager' => __DIR__ . '/../..' . '/src/FilterManager.php',
        'wirdwird\\Filters\\FilterUrlBuilder' => __DIR__ . '/../..' . '/src/FilterUrlBuilder.php',
        'wirdwird\\Filters\\GlobalFilters\\AndGlobalFilter' => __DIR__ . '/../..' . '/src/GlobalFilters/AndGlobalFilter.php',
        'wirdwird\\Filters\\GlobalFilters\\GlobalFilterFactory' => __DIR__ . '/../..' . '/src/GlobalFilters/GlobalFilterFactory.php',
        'wirdwird\\Filters\\GlobalFilters\\OrGlobalFilter' => __DIR__ . '/../..' . '/src/GlobalFilters/OrGlobalFilter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit65474ceea10d460983368213200b2b50::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit65474ceea10d460983368213200b2b50::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit65474ceea10d460983368213200b2b50::$classMap;

        }, null, ClassLoader::class);
    }
}
