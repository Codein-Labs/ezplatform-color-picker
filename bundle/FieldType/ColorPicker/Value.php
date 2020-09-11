<?php


namespace Codein\eZColorPicker\FieldType\ColorPicker;

use eZ\Publish\Core\FieldType\Value as BaseValue;

class Value extends BaseValue
{
    const FORMAT_RGBA = 'RGBa';
    const FORMAT_HEXA = 'HEXa';
    const FORMAT_HSVA = 'HSVa';
    const FORMAT_RGB = 'RGB';
    const FORMAT_HEX = 'HEX';

    public $RGBa;
    public $HEXa;
    public $HSVa;
    public $RGB;
    public $HEX;

    public function setValueFromHash(array $array)
    {
        foreach ($array as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }

    public function getValueAsHash()
    {
        return get_object_vars($this);
    }

    public function __toString()
    {
        return (string)$this->RGBa;
    }

    public function isEmpty()
    {
        foreach ($this as $key => $value) {
            if($this->{$key} === null) {
                return true;
            }
        }
        return false;
    }

    public function getValueInFormat($format)
    {
        return $this->{$format};
    }
}