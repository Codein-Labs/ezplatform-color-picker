<?php


namespace Codein\ColorConverter;


use Codein\ColorConverter\Color\HEX;
use Codein\ColorConverter\Color\HEXa;
use Codein\ColorConverter\Color\HSVa;
use Codein\ColorConverter\Color\RGBa;
use Codein\ColorConverter\Color\RGB;

trait ColorConverterTrait
{
    /**
     * @param $input
     * @param $regex
     * @return false|int
     */
    public function isInputValid($input, $regex)
    {
        return (bool)preg_match($regex, $input);
    }

    protected function convertRGBaToHSVa($RGBa)
    {
        return new HSVa($RGBa);
    }

    protected function convertHEXaToHSVa($HEXa)
    {
        return new HSVa($HEXa);
    }

    protected function convertHSVaToHEXa($HSVa)
    {
        $RGBa = $this->convertHSVaToRGBa($HSVa);
        return (new HEXa())->fromRGBa($RGBa);
    }

    protected function convertHSVaToRGBa($HSVa)
    {
        $HSVaColor = new HSVa($HSVa);
        return (new RGBa())->fromHSVa($HSVaColor);
    }

    protected function convertHSVaToHEX($HSVa)
    {
        $RGBa = $this->convertHSVaToRGBa($HSVa);
        return (new HEX())->fromRGBa($RGBa);
    }

    protected function convertHSVaToRGB($HSVa)
    {
        $HSVaColor = new HSVa($HSVa);
        return (new RGB())->fromHSVa($HSVaColor);
    }
}