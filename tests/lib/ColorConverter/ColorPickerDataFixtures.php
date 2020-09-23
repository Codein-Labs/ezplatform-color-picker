<?php


namespace Codein\Tests\ColorConverter;


interface ColorPickerDataFixtures
{
    const VALUE_HSVa = 'hsva(0, 86%, 69%, 0.69)';
    const VALUE_RGBa = 'rgba(176, 25, 25, 0.69)';
    const VALUE_HEXa = '#B01919B0';
    const VALUE_RGB = 'rgb(176, 25, 25)';
    const VALUE_HEX = '#B01919';
    const VALUE_HSV = 'hsva(0, 86%, 69%, 1.00)';

    const ARRAY_VALUE = [
        'RGBa' => self::VALUE_RGBa,
        'HEXa' => self::VALUE_HEXa,
        'HSVa' => self::VALUE_HSVa,
        'RGB' => self::VALUE_RGB,
        'HEX' => self::VALUE_HEX,
    ];

    const ARRAY_VALUE_NO_ALPHA = [
        'RGBa' => 'rgba(176, 25, 25, 1.00)',
        'HEXa' => '#B01919FF',
        'HSVa' => self::VALUE_HSV,
        'RGB' => self::VALUE_RGB,
        'HEX' => self::VALUE_HEX,
    ];
}