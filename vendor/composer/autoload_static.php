<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit32c007e2390562de058f28d0ebba630b
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Monolog\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Monolog\\' => 
        array (
            0 => __DIR__ . '/..' . '/monolog/monolog/src/Monolog',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit32c007e2390562de058f28d0ebba630b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit32c007e2390562de058f28d0ebba630b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit32c007e2390562de058f28d0ebba630b::$classMap;

        }, null, ClassLoader::class);
    }
}
