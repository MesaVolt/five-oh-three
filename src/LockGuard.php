<?php

namespace Mesavolt\FiveOhThree;


abstract class LockGuard
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
     * Checks if a lock file exists.
     * Set the FIVEOHTHREE_IGNORE_LOCK environment variable to a true-ish value (decoded with `boolval`)
     * to ignore the presence of a lock file and always return `false` (useful in deployment scripts).
     */
    public static function lockFileExists(string $path): bool
    {
        $ignoreFlag = (bool) ($_ENV['FIVEOHTHREE_IGNORE_LOCK'] ?? getenv('FIVEOHTHREE_IGNORE_LOCK') ?? false);
        if ($ignoreFlag === true) {
            return false;
        }

        return is_file($path);
    }

    /**
     * Checks if the lock file exists.
     * If so, throws a LockFileException
     *
     * @throws LockFileException
     */
    public static function checkAndThrow(array $options = []): void
    {
        $options = array_merge(self::DEFAULTS, $options);
        $lock = $options['lock_path'];

        if (self::lockFileExists($lock)) {
            throw new LockFileException($lock);
        }
    }

    /**
     * Checks if the lock file exists.
     * If so, sends a 503 Service Unavailable header, renders a pretty maintenance page and halts script execution.
     */
    public static function checkAndRender(array $options = []): void
    {
        $options = array_merge(self::DEFAULTS, $options);

        if (self::lockFileExists($options['lock_path'])) {
            header('HTTP/1.1 503 Service Unavailable');

            // Render specified (or default) template.
            include $options['template'];

            die();
        }
    }
}
