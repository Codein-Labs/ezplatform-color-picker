<?php


namespace Codein\Tests\ColorConverter;

use Codein\ColorConverter\ColorConverterTrait;

class ColorConverterTestInstance
{
    use ColorConverterTrait;

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this, $name], $arguments);
    }
}