<?php
/**
 * Created by PhpStorm.
 * User: jeremydesvaux
 * Date: 22/06/2017
 * Time: 13:28
 */

namespace WonderWp\Framework\API;

use PHPUnit\Framework\TestCase;
use WonderWp\Component\HttpFoundation\Result;

/**
 * Class ResultTest
 * @package WonderWp\Framework\API
 * @see Result
 */
class ResultTest extends TestCase
{

    public function testGetDataWithNoKeyShouldReturnAllValues()
    {
        $expected = ['msg'=>'test msg'];
        $result = new Result(200,$expected);
        $this->assertEquals($expected,$result->getData());
    }

    public function testGetDataWithKeyShouldReturnAssociatedValue()
    {
        $data = ['msg'=>'test msg'];
        $result = new Result(200,$data);
        $expected = $data['msg'];
        $this->assertEquals($expected,$result->getData('msg'));
    }
}
