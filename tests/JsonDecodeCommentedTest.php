<?php
use PHPUnit\Framework\TestCase;

/**
 * @requires extension json
 */
class JsonDecodeCommentedTest extends TestCase
{
    /**
     *
     */
    protected function setUp()
    {
        $this->object = file_get_contents(__DIR__.'/files/CommentedObject.json');
        $this->array  = file_get_contents(__DIR__.'/files/Array.json');

        KKo\Json::$Strict = false;
    }

    /**
     *
     */
    public function testDecodeCommentedObject()
    {
        $decoded = KKo\Json::decode($this->object);

        $expected = new \StdClass;
        $expected->key = 'value';

        $this->assertEquals($decoded, $expected);
    }

    /**
     *
     */
    public function testDecodeCommentedObjectToArray()
    {
        $decoded = KKo\Json::decode($this->object, true);

        $expected = array('key' => 'value');

        $this->assertEquals($decoded, $expected);
    }

    /**
     *
     */
    public function testDecodeCommentedArray()
    {
        $decoded = KKo\Json::decode($this->array);

        $expected = array('key', 'value');

        $this->assertEquals($decoded, $expected);
    }

}
