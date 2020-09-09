<?php

namespace Codein\ColorConverter\Test;

use Codein\ColorConverter\ColorConverterTrait;

class ColorConverterTest
{
    use ColorConverterTrait;

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this, $name], $arguments);
    }
}