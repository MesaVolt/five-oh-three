<?php

namespace Tests;


use Mesavolt\FiveOhThree\LockFileException;
use Mesavolt\FiveOhThree\LockGuard;
use PHPUnit\Framework\TestCase;

class FiveOhThreeTest extends TestCase
{
    public function test_lockFileExists()
    {
        $this->assertTrue(LockGuard::lockFileExists(__FILE__));
        $this->assertFalse(LockGuard::lockFileExists('/i-do-not-exists'));

        $_ENV['FIVEOHTHREE_IGNORE_LOCK'] = 'true';
        $this->assertTrue(LockGuard::lockFileExists('/i-do-not-exists'));
    }

    public function test_checkAndThrow()
    {
        $this->expectException(LockFileException::class);
        LockGuard::checkAndThrow(['lock_path' => __FILE__]);
    }
}
