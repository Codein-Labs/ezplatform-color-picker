<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;

use eZ\Publish\SPI\FieldType\Value as ValueInterface;

final class Value implements ValueInterface
{
    public $RGBa;
    public $HEXa;
    public $HSVa;
    public $RGB;
    public $HEX;

    public function __toString()
    {
        return (string)$this->RGBa;
    }
}