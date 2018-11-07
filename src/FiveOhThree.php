<?php

abstract class FiveOhThree
{
    private const DEFAULTS = [
        'lock_path' => __DIR__.'/../../../../deploying.lock',
        'template' => __DIR__.'/../res/template.php',

        // default template configuration
        'auto_refresh' => true,
        'auto_refresh_interval' => 8,
        'icon' => '/apple-touch-icon.png',
    ];

    /**
     * Checks if the lock file exists.
     * If so, sends a 503 Service Unavailable header, renders a pretty maintenance page and halts script execution.
     */
    public static function checkAndRender(array $options = []): void
    {
        $options = array_merge(self::DEFAULTS, $options);

        if (is_file($options['lock_path'])) {
            header('HTTP/1.1 503 Service Unavailable');

            // Make some variables accessible to the template.
            include $options['template'];

            die();
        }
    }
}
