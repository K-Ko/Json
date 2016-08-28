<?php
use PHPUnit\Framework\TestCase;

/**
 * @requires extension json
 */
class JsonEncodeFileTest extends TestCase
{
    /**
     *
     */
    protected function setUp()
    {
        $this->file = tempnam('/tmp', 'test');
    }

    /**
     *
     */
    protected function tearDown()
    {
        unlink($this->file);
    }

    /**
     *
     */
    public function testEncodeObjectToFile()
    {
        $data = new \StdClass;
        $data->key = 'value';

        $encoded = KKo\Json::encodeToFile($this->file, $data);

        $this->assertEquals($encoded, 15);
        $this->assertJsonFileEqualsJsonFile(__DIR__.'/files/Object.json', $this->file);
    }

    /**
     *
     */
    public function testEncodeArrayToFile()
    {
        $data = array('key', 'value');

        $encoded = KKo\Json::encodeToFile($this->file, $data);

        $this->assertEquals($encoded, 15);
        $this->assertJsonFileEqualsJsonFile(__DIR__.'/files/Array.json', $this->file);
    }

    /**
     *
     */
    protected $file;

}
