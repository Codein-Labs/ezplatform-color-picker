<?php

use PHPUnit\Framework\TestCase;
use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;
use Codein\Tests\ColorConverter\ColorConverterTest;

class ValueTest extends TestCase
{
    /**
     * @var ColorPickerValue
     */
    private $value;

    private $data = [
        'RGBa' => ColorConverterTest::VALUE_RGBa,
        'HEXa' => ColorConverterTest::VALUE_HEXa,
        'HSVa' => ColorConverterTest::VALUE_HSVa,
        'RGB' => ColorConverterTest::VALUE_RGB,
        'HEX' => ColorConverterTest::VALUE_HEX,
    ];

    public function setUp(): void
    {
        $this->value = new ColorPickerValue();
    }

    public function testIsEmpty()
    {
        $this->assertTrue($this->value->isEmpty());
    }

    public function testHashFunctions()
    {
        $this->value->setValueFromHash($this->data);
        $this->assertFalse($this->value->isEmpty());

        $hash = $this->value->getValueAsHash();
        foreach ($this->data as $key => $value) {
            $this->assertArrayHasKey($key, $hash);
            $this->assertEquals($value, $hash[$key]);
        }
    }
}