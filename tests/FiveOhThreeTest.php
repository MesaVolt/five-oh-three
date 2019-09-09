<?php

namespace Tests;


use Mesavolt\FiveOhThree\LockFileException;
use Mesavolt\FiveOhThree\LockGuard;
use PHPUnit\Framework\TestCase;

class FiveOhThreeTest extends TestCase
{
    protected function tearDown()
    {
        parent::tearDown();

        // ensure each test gets a clean env
        unset($_ENV['FIVEOHTHREE_IGNORE_LOCK']);
        putenv('FIVEOHTHREE_IGNORE_LOCK');
    }

    public function test_lockFileExists()
    {
        $this->assertTrue(LockGuard::lockFileExists(__FILE__), 'Lock file should be detected');
        $this->assertFalse(LockGuard::lockFileExists('/i-do-not-exist'), "Lock file shouldn't be detected");

        $_ENV['FIVEOHTHREE_IGNORE_LOCK'] = 'true';
        $this->assertFalse(LockGuard::lockFileExists(__FILE__), 'Lock file should be ignored');

        unset($_ENV['FIVEOHTHREE_IGNORE_LOCK']);
        $this->assertTrue(LockGuard::lockFileExists(__FILE__), 'Lock file should be detected again');

        putenv('FIVEOHTHREE_IGNORE_LOCK=true');
        $this->assertFalse(LockGuard::lockFileExists(__FILE__), 'Lock file should be ignored again');
    }

    public function test_checkAndThrow()
    {
        $this->expectException(LockFileException::class);
        LockGuard::checkAndThrow(['lock_path' => __FILE__]);
    }
}
