<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitba8ba2a5fff9120b5883d6bbd510fbd8
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitba8ba2a5fff9120b5883d6bbd510fbd8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitba8ba2a5fff9120b5883d6bbd510fbd8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitba8ba2a5fff9120b5883d6bbd510fbd8::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
