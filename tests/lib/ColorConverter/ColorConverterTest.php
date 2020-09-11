<?php

namespace Codein\Tests\ColorConverter;

use Codein\ColorConverter\Color\HSVa;
use Codein\ColorConverter\ColorConverter;
use PHPUnit\Framework\TestCase;

class ColorConverterTest extends TestCase
{
    const VALUE_HSVa = 'hsva(0, 86%, 69%, 0.69)';
    const VALUE_RGBa = 'rgba(176, 25, 25, 0.69)';
    const VALUE_HEXa = '#B01919B0';
    const VALUE_RGB = 'rgb(176, 25, 25)';
    const VALUE_HEX = '#B01919';
    const VALUE_HSV = 'hsva(0, 86%, 69%, 1.00)';

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
        $this->HSVa = $this->instance->convertStringToHSVa(self::VALUE_HSVa);

    }

    public function testInputHSVa()
    {
        $this->assertTrue($this->instance->isInputValid(self::VALUE_HSVa, ColorConverter::INPUT_HSVA));
        $this->assertFalse($this->instance->isInputValid(self::VALUE_HSVa, ColorConverter::INPUT_RGBA));
        $this->assertFalse($this->instance->isInputValid(self::VALUE_HSVa, ColorConverter::INPUT_HEXA));
    }

    public function testInputRGBa()
    {
        $this->assertFalse($this->instance->isInputValid(self::VALUE_RGBa, ColorConverter::INPUT_HSVA));
        $this->assertTrue($this->instance->isInputValid(self::VALUE_RGBa, ColorConverter::INPUT_RGBA));
        $this->assertFalse($this->instance->isInputValid(self::VALUE_RGBa, ColorConverter::INPUT_HEXA));
    }

    public function testInputHEXa()
    {
        $this->assertFalse($this->instance->isInputValid(self::VALUE_HEXa, ColorConverter::INPUT_HSVA));
        $this->assertFalse($this->instance->isInputValid(self::VALUE_HEXa, ColorConverter::INPUT_RGBA));
        $this->assertTrue($this->instance->isInputValid(self::VALUE_HEXa, ColorConverter::INPUT_HEXA));
    }

    public function testInputRGB()
    {
        $this->assertFalse($this->instance->isInputValid(self::VALUE_RGB, ColorConverter::INPUT_HSVA));
        $this->assertTrue($this->instance->isInputValid(self::VALUE_RGB, ColorConverter::INPUT_RGBA));
        $this->assertFalse($this->instance->isInputValid(self::VALUE_RGB, ColorConverter::INPUT_HEXA));
    }

    public function testInputHEX()
    {
        $this->assertFalse($this->instance->isInputValid(self::VALUE_HEX, ColorConverter::INPUT_HSVA));
        $this->assertFalse($this->instance->isInputValid(self::VALUE_HEX, ColorConverter::INPUT_RGBA));
        $this->assertTrue($this->instance->isInputValid(self::VALUE_HEX, ColorConverter::INPUT_HEXA));
    }

    public function testConvertStringToHSVa()
    {
        $values = [
            self::VALUE_HSVa,
            self::VALUE_RGBa,
            self::VALUE_HEXa,
        ];
        foreach ($values as $value) {
            $this->assertEquals(self::VALUE_HSVa,
                (string)$this->instance->convertStringToHSVa($value),
                'Input string is '.$value
            );
        }
        $values = [
            self::VALUE_RGB,
            self::VALUE_HEX,
        ];
        foreach ($values as $value) {
            $this->assertEquals(self::VALUE_HSV,
                (string)$this->instance->convertStringToHSVa($value),
                'Input string is '.$value
            );
        }
    }

    public function testConvertHSVa() {
        $this->assertEquals(self::VALUE_RGBa, $this->instance->convertHSVaToRGBa($this->HSVa));
        $this->assertEquals(self::VALUE_HEXa, $this->instance->convertHSVaToHEXa($this->HSVa));
        $this->assertEquals(self::VALUE_RGB, $this->instance->convertHSVaToRGB($this->HSVa));
        $this->assertEquals(self::VALUE_HEX, $this->instance->convertHSVaToHEX($this->HSVa));
    }
}