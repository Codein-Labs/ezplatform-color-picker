<?php


namespace Codein\ColorConverter\Color;


class HEX extends HEXa
{
    public function __toString()
    {
        if (strlen($this->HEXa) == 9) {
            return substr($this->HEXa, 0, 7);
        }
        return "";
    }
}