<?php
use PHPUnit\Framework\TestCase;

/**
 * @requires extension json
 */
class JsonEncodeTest extends TestCase
{
    /**
     *
     */
    public function testEncodeObject()
    {
        $data = new \StdClass;
        $data->key = 'value';

        $encoded = KKo\Json::encode($data);

        $this->assertJsonStringEqualsJsonFile(__DIR__.'/files/Object.json', $encoded);
    }

    /**
     *
     */
    public function testEncodeArray()
    {
        $data = array('key', 'value');

        $encoded = KKo\Json::encode($data);

        $this->assertJsonStringEqualsJsonFile(__DIR__.'/files/Array.json', $encoded);
    }

}
