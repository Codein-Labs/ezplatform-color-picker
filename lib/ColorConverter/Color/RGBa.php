<?php

namespace Codein\ColorConverter\Color;

class RGBa
{
    const FORMAT = "rgba(%d, %d, %d, %.2f)";

    public $R;

    public $G;

    public $B;

    public $a;

    public function fromHSVa(HSVa $HSVa)
    {
        $h = ($HSVa->H / 360) * 6;
        $s = $HSVa->S / 100;
        $v = $HSVa->V / 100;

        $i = floor($h);

        $f = $h - $i;
        $p = $v * (1 - $s);
        $q = $v * (1 - $f * $s);
        $t = $v * (1 - (1 - $f) * $s);

        $mod = $i % 6;
        $r = [$v, $q, $p, $p, $t, $v][$mod];
        $g = [$t, $v, $v, $q, $p, $p][$mod];
        $b = [$p, $p, $t, $v, $v, $q][$mod];

        $this->R = round($r * 255);
        $this->G = round($g * 255);
        $this->B = round($b * 255);
        $this->a = $HSVa->a;

        return $this;
    }

    public function __toString()
    {
        return sprintf(self::FORMAT, $this->R, $this->G, $this->B, $this->a);
    }
}