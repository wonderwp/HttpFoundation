<?php

declare(strict_types=1);

namespace WonderWp\Component\HttpFoundation\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WonderWp\Component\HttpFoundation\Result;

final class ResultTest extends TestCase
{
    public function testGetDataWithNoKeyShouldReturnAllValues(): void
    {
        $expected = ['msg' => 'test msg'];
        $result = new Result(200, $expected);
        $this->assertSame($expected, $result->getData());
    }

    public function testGetDataWithKeyShouldReturnAssociatedValue(): void
    {
        $data = ['msg' => 'test msg'];
        $result = new Result(200, $data);
        $this->assertSame('test msg', $result->getData('msg'));
    }
}
