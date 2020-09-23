<?php


namespace Codein\ColorConverter\Color;


class HEXa
{
    public $HEXa;

    public function fromRGBa(RGBa $RGBa)
    {
        $this->HEXa  = '#';
        $this->HEXa .= str_pad(dechex($RGBa->R), 2, 0, STR_PAD_LEFT);
        $this->HEXa .= str_pad(dechex($RGBa->G), 2, 0, STR_PAD_LEFT);
        $this->HEXa .= str_pad(dechex($RGBa->B), 2, 0, STR_PAD_LEFT);
        $this->HEXa .= str_pad(dechex(round($RGBa->a*255)), 2, 0, STR_PAD_LEFT);
        $this->HEXa = strtoupper($this->HEXa);
        return $this;
    }

    public function __toString()
    {
        if (strlen($this->HEXa) == 9) {
            return $this->HEXa;
        }
        return "";
    }
}