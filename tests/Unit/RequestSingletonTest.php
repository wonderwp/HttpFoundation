<?php

declare(strict_types=1);

namespace WonderWp\Component\HttpFoundation\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use WonderWp\Component\HttpFoundation\Request;

final class RequestSingletonTest extends TestCase
{
    protected function setUp(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        $this->resetRequestSingleton();
    }

    protected function tearDown(): void
    {
        $this->resetRequestSingleton();
    }

    public function testBuildInstanceCreatesSessionOnce(): void
    {
        $built = Request::buildInstance();

        $this->assertTrue($built->hasSession());
        $this->assertInstanceOf(Session::class, $built->getSession());
    }

    public function testGetInstanceReusesSameObjectAndSession(): void
    {
        $first = Request::getInstance();
        $second = Request::getInstance();

        $this->assertSame($first, $second);
        $this->assertTrue($first->hasSession());
        $this->assertSame($first->getSession(), $second->getSession());
    }

    private function resetRequestSingleton(): void
    {
        $reflection = new \ReflectionClass(Request::class);
        $property = $reflection->getProperty('singletonInstance');
        $property->setValue(null, null);
    }
}
