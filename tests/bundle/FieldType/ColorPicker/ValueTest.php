<?php

use PHPUnit\Framework\TestCase;
use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;
use Codein\Tests\ColorConverter\ColorConverterTraitTest;

class ValueTest extends TestCase
{
    /**
     * @var ColorPickerValue
     */
    private $value;

    private $data = [
        'RGBa' => ColorConverterTraitTest::VALUE_RGBa,
        'HEXa' => ColorConverterTraitTest::VALUE_HEXa,
        'HSVa' => ColorConverterTraitTest::VALUE_HSVa,
        'RGB' => ColorConverterTraitTest::VALUE_RGB,
        'HEX' => ColorConverterTraitTest::VALUE_HEX,
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