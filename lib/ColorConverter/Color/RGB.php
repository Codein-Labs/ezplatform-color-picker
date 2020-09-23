<?php

namespace Codein\ColorConverter\Color;

class RGB extends RGBa
{
    const FORMAT = "rgb(%d, %d, %d)";

    public function __toString()
    {
        return sprintf(self::FORMAT, $this->R, $this->G, $this->B, $this->a);
    }
}