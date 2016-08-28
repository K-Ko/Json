<?php
use PHPUnit\Framework\TestCase;

/**
 * @requires extension json
 */
class JsonDecodePlainTest extends TestCase
{
    /**
     *
     */
    protected function setUp()
    {
        $this->object = file_get_contents(__DIR__.'/files/Object.json');
        $this->array  = file_get_contents(__DIR__.'/files/Array.json');
    }

    /**
     *
     */
    public function testDecodePlainObject()
    {
        $decoded = KKo\Json::decode($this->object);

        $expected = new \StdClass;
        $expected->key = 'value';

        $this->assertEquals($decoded, $expected);
    }

    /**
     *
     */
    public function testDecodePlainObjectToArray()
    {
        $decoded = KKo\Json::decode($this->object, true);

        $expected = array('key' => 'value');

        $this->assertEquals($decoded, $expected);
    }

    /**
     *
     */
    public function testDecodePlainArray()
    {
        $decoded = KKo\Json::decode($this->array);

        $expected = array('key', 'value');

        $this->assertEquals($decoded, $expected);
    }

    /**
     * @expectedException RunTimeException
     */
    public function testInvalidJsonException()
    {
        $json = '{"key":"value",}';

        $decoded = KKo\Json::decode($json);
    }

}
