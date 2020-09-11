<?php

use Codein\Tests\ColorConverter\ColorPickerDataFixtures;
use PHPUnit\Framework\TestCase;
use Codein\eZColorPicker\FieldType\ColorPicker\Value as ColorPickerValue;
use Codein\Tests\ColorConverter\ColorConverterTest;

class ValueTest extends TestCase
{
    /**
     * @var ColorPickerValue
     */
    private $value;

    /**
     * @var string[]
     */
    private $data;

    public function setUp(): void
    {
        $this->value = new ColorPickerValue();
        $this->data = ColorPickerDataFixtures::ARRAY_VALUE;
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