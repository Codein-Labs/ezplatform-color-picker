<?php


namespace Codein\ColorConverter;


use Codein\ColorConverter\Color\HEX;
use Codein\ColorConverter\Color\HEXa;
use Codein\ColorConverter\Color\HSVa;
use Codein\ColorConverter\Color\RGB;
use Codein\ColorConverter\Color\RGBa;

class ColorConverter
{
    const INPUT_HSVA = '/^((hsva)|hsv)[\D]+([\d.]+)[\D]+([\d.]+)[\D]+([\d.]+)[\D]*?([\d.]+|$)/i';
    const INPUT_RGBA = '/^((rgba)|rgb)[\D]+([\d.]+)[\D]+([\d.]+)[\D]+([\d.]+)[\D]*?([\d.]+|$)/i';
    const INPUT_HEXA = '/^#?(([\dA-Fa-f]{3,4})|([\dA-Fa-f]{6})|([\dA-Fa-f]{8}))$/i';

    /**
     * @param $input
     * @param $regex
     * @return bool
     */
    public function isInputValid($input, $regex)
    {
        return (bool)preg_match($regex, $input);
    }

    /**
     * @param $input
     * @return bool
     */
    public function stringIsColor($input)
    {
        return $this->isInputValid($input, self::INPUT_HSVA)
            || $this->isInputValid($input, self::INPUT_RGBA)
            || $this->isInputValid($input, self::INPUT_HEXA);
    }

    /**
     * @param $string
     * @return HSVa
     */
    public function convertStringToHSVa($string)
    {
        $matches = [];

        if(preg_match(self::INPUT_HSVA, $string, $matches)) {
            return HSVa::getFromHSVaMatches($matches);
        } elseif(preg_match(self::INPUT_RGBA, $string, $matches)) {
            return HSVa::getFromRGBaMatches($matches);
        } elseif(preg_match(self::INPUT_HEXA, $string, $matches)) {
            return HSVa::getFromHEXaMatches($matches);
        }
        return new HSVa();
    }

    /**
     * @param HSVa $HSVa
     * @return HEXa
     */
    public function convertHSVaToHEXa(HSVa $HSVa)
    {
        $RGBa = $this->convertHSVaToRGBa($HSVa);
        return (new HEXa())->fromRGBa($RGBa);
    }

    /**
     * @param HSVa $HSVa
     * @return RGBa
     */
    public function convertHSVaToRGBa(HSVa $HSVa)
    {
        return (new RGBa())->fromHSVa($HSVa);
    }

    /**
     * @param HSVa $HSVa
     * @return HEX
     */
    public function convertHSVaToHEX(HSVa $HSVa)
    {
        $RGBa = $this->convertHSVaToRGBa($HSVa);
        return (new HEX())->fromRGBa($RGBa);
    }

    /**
     * @param HSVa $HSVa
     * @return RGB
     */
    public function convertHSVaToRGB(HSVa $HSVa)
    {
        return (new RGB())->fromHSVa($HSVa);
    }
}