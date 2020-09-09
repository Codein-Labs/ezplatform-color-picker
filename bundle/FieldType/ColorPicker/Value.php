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

    public function setValueFromArray(array $array)
    {
        foreach ($array as $key => $value) {
            if(property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }

    public function getValueAsArray()
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
}