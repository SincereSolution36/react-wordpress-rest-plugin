<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8c2c3926820c8f6513eb965dd832c750
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pc\\ChartWpRestApi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pc\\ChartWpRestApi\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8c2c3926820c8f6513eb965dd832c750::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8c2c3926820c8f6513eb965dd832c750::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8c2c3926820c8f6513eb965dd832c750::$classMap;

        }, null, ClassLoader::class);
    }
}
