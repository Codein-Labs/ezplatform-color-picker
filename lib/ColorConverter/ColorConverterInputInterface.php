<?php


namespace Codein\ColorConverter;


interface ColorConverterInputInterface
{
    const INPUT_HSVA = '/^((hsva)|hsv)[\D]+([\d.]+)[\D]+([\d.]+)[\D]+([\d.]+)[\D]*?([\d.]+|$)/i';
    const INPUT_RGBA = '/^((rgba)|rgb)[\D]+([\d.]+)[\D]+([\d.]+)[\D]+([\d.]+)[\D]*?([\d.]+|$)/i';
    const INPUT_HEXA = '/^#?(([\dA-Fa-f]{3,4})|([\dA-Fa-f]{6})|([\dA-Fa-f]{8}))$/i';
}