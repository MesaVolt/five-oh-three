<?php

namespace Tests;


use Mesavolt\FiveOhThree\LockFileException;
use Mesavolt\FiveOhThree\LockGuard;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class FiveOhThreeTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();

        // ensure each test gets a clean env
        unset($_ENV['FIVEOHTHREE_IGNORE_LOCK']);
        putenv('FIVEOHTHREE_IGNORE_LOCK');
    }

    public function test_lockFileExists(): void
    {
        self::assertTrue(LockGuard::lockFileExists(__FILE__), 'Lock file should be detected');
        self::assertFalse(LockGuard::lockFileExists('/i-do-not-exist'), "Lock file shouldn't be detected");

        $_ENV['FIVEOHTHREE_IGNORE_LOCK'] = 'true';
        self::assertFalse(LockGuard::lockFileExists(__FILE__), 'Lock file should be ignored');

        unset($_ENV['FIVEOHTHREE_IGNORE_LOCK']);
        self::assertTrue(LockGuard::lockFileExists(__FILE__), 'Lock file should be detected again');

        putenv('FIVEOHTHREE_IGNORE_LOCK=true');
        self::assertFalse(LockGuard::lockFileExists(__FILE__), 'Lock file should be ignored again');
    }

    public function test_checkAndThrow(): void
    {
        $this->expectException(LockFileException::class);
        LockGuard::checkAndThrow(['lock_path' => __FILE__]);
    }

    private function invokeGetResponse(?string $acceptHeader): array
    {
        $reflection = new ReflectionClass(LockGuard::class);
        $method = $reflection->getMethod('getResponse');
        $method->setAccessible(true);
        return $method->invokeArgs(null, [
            [
                'template' => __DIR__.'/../res/template.php',
                'auto_refresh' => true,
                'auto_refresh_interval' => 8,
                'icon' => '/apple-touch-icon.png',
            ],
            $acceptHeader
        ]);
    }

    /**
     * @dataProvider dataProvider_getResponse
     */
    public function test_getResponse(?string $acceptHeader, bool $expectJson): void
    {
        [$headers, $body] = $this->invokeGetResponse($acceptHeader);

        self::assertContains('HTTP/1.1 503 Service Temporarily Unavailable', $headers);
        self::assertContains('Retry-After: 8', $headers);

        if ($expectJson) {
            self::assertSame('{"success": false}', $body);
            self::assertContains('Content-Type: application/json; charset=utf-8', $headers);
        } else {
            self::assertStringContainsString('<!DOCTYPE html>', $body);
            self::assertContains('Content-Type: text/html; charset=utf-8', $headers);
        }
    }

    public function dataProvider_getResponse(): array
    {
        return [
            ['application/json', true],
            ['application/json, text/javascript, */*; q=0.01', true],
            ['text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8', false],
            ['*/*', false],
            [null, false],
        ];
    }
}
