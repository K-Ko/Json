<?php
use PHPUnit\Framework\TestCase;

/**
 * @requires extension json
 */
class JsonDecodePlainFileTest extends TestCase
{
    /**
     *
     */
    public function testDecodePlainObject()
    {
        $expected = new \StdClass;
        $expected->key = 'value';

        $decoded = KKo\Json::decodeFile(__DIR__.'/files/Object.json');

        $this->assertEquals($decoded, $expected);
    }

    /**
     *
     */
    public function testDecodePlainObjectToArray()
    {
        $expected = array('key' => 'value');

        $decoded = KKo\Json::decodeFile(__DIR__.'/files/Object.json', true);

        $this->assertEquals($decoded, $expected);
    }

    /**
     *
     */
    public function testDecodePlainArray()
    {
        $expected = array('key', 'value');

        $decoded = KKo\Json::decodeFile(__DIR__.'/files/Array.json');

        $this->assertEquals($decoded, $expected);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidJsonException()
    {
        $decoded = KKo\Json::decodeFile('InvalidFile');
    }

}
