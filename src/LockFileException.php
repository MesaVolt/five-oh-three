<?php

namespace Mesavolt\FiveOhThree;


/**
 * Exception thrown by the LockGuard when a lock file is detected
 */
class LockFileException extends \Exception
{
    public $lock;

    public function __construct(string $lock)
    {
        $this->lock = $lock;

        parent::__construct("Lock file `$this->lock` detected", 0, null);
    }
}
