<?php

namespace Codein\Tests\ColorConverter;

use Codein\ColorConverter\Color\HSVa;
use Codein\ColorConverter\ColorConverterInputInterface;
use PHPUnit\Framework\TestCase;

class ColorConverterTraitTest extends TestCase
{
    const VALUE_HSVa = 'hsva(0, 86%, 69%, 0.69)';
    const VALUE_RGBa = 'rgba(176, 25, 25, 0.69)';
    const VALUE_HEXa = '#B01919B0';
    const VALUE_RGB = 'rgb(176, 25, 25)';
    const VALUE_HEX = '#B01919';

    protected function getInstance()
    {
        return new ColorConverterTestInstance();
    }

    public function testInputHSVa()
    {
        $converter = $this->getInstance();
        $this->assertTrue($converter->isInputValid(self::VALUE_HSVa, ColorConverterInputInterface::INPUT_HSVA));
        $this->assertFalse($converter->isInputValid(self::VALUE_HSVa, ColorConverterInputInterface::INPUT_RGBA));
        $this->assertFalse($converter->isInputValid(self::VALUE_HSVa, ColorConverterInputInterface::INPUT_HEXA));
    }

    public function testInputRGBa()
    {
        $converter = $this->getInstance();
        $this->assertFalse($converter->isInputValid(self::VALUE_RGBa, ColorConverterInputInterface::INPUT_HSVA));
        $this->assertTrue($converter->isInputValid(self::VALUE_RGBa, ColorConverterInputInterface::INPUT_RGBA));
        $this->assertFalse($converter->isInputValid(self::VALUE_RGBa, ColorConverterInputInterface::INPUT_HEXA));
    }

    public function testInputHEXa()
    {
        $converter = $this->getInstance();
        $this->assertFalse($converter->isInputValid(self::VALUE_HEXa, ColorConverterInputInterface::INPUT_HSVA));
        $this->assertFalse($converter->isInputValid(self::VALUE_HEXa, ColorConverterInputInterface::INPUT_RGBA));
        $this->assertTrue($converter->isInputValid(self::VALUE_HEXa, ColorConverterInputInterface::INPUT_HEXA));
    }

    public function testInputRGB()
    {
        $converter = $this->getInstance();
        $this->assertFalse($converter->isInputValid(self::VALUE_RGB, ColorConverterInputInterface::INPUT_HSVA));
        $this->assertTrue($converter->isInputValid(self::VALUE_RGB, ColorConverterInputInterface::INPUT_RGBA));
        $this->assertFalse($converter->isInputValid(self::VALUE_RGB, ColorConverterInputInterface::INPUT_HEXA));
    }

    public function testInputHEX()
    {
        $converter = $this->getInstance();
        $this->assertFalse($converter->isInputValid(self::VALUE_HEX, ColorConverterInputInterface::INPUT_HSVA));
        $this->assertFalse($converter->isInputValid(self::VALUE_HEX, ColorConverterInputInterface::INPUT_RGBA));
        $this->assertTrue($converter->isInputValid(self::VALUE_HEX, ColorConverterInputInterface::INPUT_HEXA));
    }

    public function testHSVa()
    {
        $HSVa = new HSVa(self::VALUE_HSVa);
        $this->assertEquals(self::VALUE_HSVa, (string)$HSVa);

        $HSVa = new HSVa(self::VALUE_RGBa);
        $this->assertEquals(self::VALUE_HSVa, (string)$HSVa);

        $HSVa = new HSVa(self::VALUE_HEXa);
        $this->assertEquals(self::VALUE_HSVa, (string)$HSVa);
    }

    public function testConvertHSVaToRGBa()
    {
        $converter = $this->getInstance();
        $this->assertEquals(self::VALUE_RGBa, (string)$converter->convertHSVaToRGBa(self::VALUE_HSVa));
    }

    public function testConvertRGBaToHSVa()
    {
        $converter = $this->getInstance();
        $this->assertEquals(self::VALUE_HSVa, (string)$converter->convertRGBaToHSVa(self::VALUE_RGBa));
    }

    public function testConvertHEXaToHSVa()
    {
        $converter = $this->getInstance();
        $this->assertEquals(self::VALUE_HSVa, (string)$converter->convertHEXaToHSVa(self::VALUE_HEXa));
    }

    public function testConvertHSVaToHEXa()
    {
        $converter = $this->getInstance();
        $this->assertEquals(self::VALUE_HEXa, (string)$converter->convertHSVaToHEXa(self::VALUE_HSVa));
    }

    public function testConvertHSVaToHEX()
    {
        $converter = $this->getInstance();
        $this->assertEquals(self::VALUE_HEX, (string)$converter->convertHSVaToHEX(self::VALUE_HSVa));
    }

    public function testConvertHSVaToRGB()
    {
        $converter = $this->getInstance();
        $this->assertEquals(self::VALUE_RGB, (string)$converter->convertHSVaToRGB(self::VALUE_HSVa));
    }
}