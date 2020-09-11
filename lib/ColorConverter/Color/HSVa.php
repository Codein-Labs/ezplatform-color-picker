<?php

namespace Codein\ColorConverter\Color;

class HSVa
{
    const FORMAT = "hsva(%d, %d%%, %d%%, %.2f)";

    public $H = 0;
    public $S = 0;
    public $V = 0;
    public $a = 0;

    public static function getFromHSVaMatches(array $matches)
    {
        return (new HSVa())->fromHSVaMatches($matches);
    }

    public static function getFromRGBaMatches(array $matches)
    {
        return (new HSVa())->fromRGBaMatches($matches);
    }

    public static function getFromHEXaMatches(array $matches)
    {
        return (new HSVa())->fromHEXaMatches($matches);
    }

    protected function fromHSVaMatches($matches)
    {
        $this->H = $matches[3];
        $this->S = $matches[4];
        $this->V = $matches[5];
        $this->a = $matches[6];
        return $this;
    }

    protected function fromRGBaMatches($matches)
    {
        $R = $matches[3]/255;
        $G = $matches[4]/255;
        $B = $matches[5]/255;

        $min = min($R, $G, $B);
        $max = max($R, $G, $B);
        $delta = $max - $min;

        $this->V = $max;

        if($delta == 0) {
            $this->H = 0;
            $this->S = 0;
        } else {
            $this->S = $delta / $max;
            $dr = ((($max - $R) / 6) + ($delta / 2)) / $delta;
            $dg = ((($max - $G) / 6) + ($delta / 2)) / $delta;
            $db = ((($max - $B) / 6) + ($delta / 2)) / $delta;

            if ($R === $max) {
                $this->H = $db - $dg;
            } elseif ($G === $max) {
                $this->H = (1 / 3) + $dr - $db;
            } elseif ($B === $max) {
                $this->H = (2 / 3) + $dg - $dr;
            }

            if ($this->H < 0) {
                $this->H += 1;
            } else if ($this->H > 1) {
                $this->H -= 1;
            }
        }

        $this->H = round($this->H * 360);
        $this->S = round($this->S * 100);
        $this->V = round($this->V * 100);

        if(isset($matches[6]) && strlen($matches[6] > 0)) {
            $this->a = $matches[6];
        } else {
            $this->a = 1;
        }
        return $this;
    }

    protected function fromHEXaMatches($matches)
    {
        $parts = str_split($matches[1], 2);
        $RGBaMatches = [
            3 => hexdec($parts[0]),
            4 => hexdec($parts[1]),
            5 => hexdec($parts[2]),
            6 => 1,
        ];
        if(count($parts) == 4) {
            $RGBaMatches[6] = hexdec($parts['3'])/255;
        }
        $this->fromRGBaMatches($RGBaMatches);
        return $this;
    }

    public function __toString()
    {
        return sprintf(self::FORMAT, $this->H, $this->S, $this->V, $this->a);
    }
}
