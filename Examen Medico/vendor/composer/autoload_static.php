<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb24c11b6f9c7589707502b960754632f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb24c11b6f9c7589707502b960754632f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb24c11b6f9c7589707502b960754632f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb24c11b6f9c7589707502b960754632f::$classMap;

        }, null, ClassLoader::class);
    }
}