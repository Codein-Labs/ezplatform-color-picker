<?php

namespace Codein\Tests\ColorConverter;

use Codein\ColorConverter\Color\HSVa;
use Codein\ColorConverter\ColorConverter;
use PHPUnit\Framework\TestCase;

class ColorConverterTest extends TestCase
{
    /**
     * @var ColorConverter
     */
    private $instance;

    /**
     * @var HSVa
     */
    private $HSVa;

    public function setUp(): void
    {
        $this->instance = new ColorConverter();
        $this->HSVa = $this->instance->convertStringToHSVa(ColorPickerDataFixtures::VALUE_HSVa);

    }

    public function testInputHSVa()
    {
        $this->assertTrue($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HSVa, ColorConverter::INPUT_HSVA));
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HSVa, ColorConverter::INPUT_RGBA));
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HSVa, ColorConverter::INPUT_HEXA));
    }

    public function testInputRGBa()
    {
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_RGBa, ColorConverter::INPUT_HSVA));
        $this->assertTrue($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_RGBa, ColorConverter::INPUT_RGBA));
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_RGBa, ColorConverter::INPUT_HEXA));
    }

    public function testInputHEXa()
    {
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HEXa, ColorConverter::INPUT_HSVA));
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HEXa, ColorConverter::INPUT_RGBA));
        $this->assertTrue($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HEXa, ColorConverter::INPUT_HEXA));
    }

    public function testInputRGB()
    {
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_RGB, ColorConverter::INPUT_HSVA));
        $this->assertTrue($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_RGB, ColorConverter::INPUT_RGBA));
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_RGB, ColorConverter::INPUT_HEXA));
    }

    public function testInputHEX()
    {
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HEX, ColorConverter::INPUT_HSVA));
        $this->assertFalse($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HEX, ColorConverter::INPUT_RGBA));
        $this->assertTrue($this->instance->isInputValid(ColorPickerDataFixtures::VALUE_HEX, ColorConverter::INPUT_HEXA));
    }

    public function testConvertStringToHSVa()
    {
        $values = [
            ColorPickerDataFixtures::VALUE_HSVa,
            ColorPickerDataFixtures::VALUE_RGBa,
            ColorPickerDataFixtures::VALUE_HEXa,
        ];
        foreach ($values as $value) {
            $this->assertEquals(ColorPickerDataFixtures::VALUE_HSVa,
                (string)$this->instance->convertStringToHSVa($value),
                'Input string is '.$value
            );
        }
        $values = [
            ColorPickerDataFixtures::VALUE_RGB,
            ColorPickerDataFixtures::VALUE_HEX,
        ];
        foreach ($values as $value) {
            $this->assertEquals(ColorPickerDataFixtures::VALUE_HSV,
                (string)$this->instance->convertStringToHSVa($value),
                'Input string is '.$value
            );
        }
    }

    public function testConvertHSVa() {
        $this->assertEquals(ColorPickerDataFixtures::VALUE_RGBa, $this->instance->convertHSVaToRGBa($this->HSVa));
        $this->assertEquals(ColorPickerDataFixtures::VALUE_HEXa, $this->instance->convertHSVaToHEXa($this->HSVa));
        $this->assertEquals(ColorPickerDataFixtures::VALUE_RGB, $this->instance->convertHSVaToRGB($this->HSVa));
        $this->assertEquals(ColorPickerDataFixtures::VALUE_HEX, $this->instance->convertHSVaToHEX($this->HSVa));
    }
}