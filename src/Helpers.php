<?php


namespace IsaEken\Blockies;


use Intervention\Image\Image;
use InvalidArgumentException;
use Spatie\Color\Hsl;

class Helpers
{
    /**
     * @param Image $canvas
     * @param mixed $color
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @return Image
     */
    public static function drawBlockToCanvas(Image $canvas, mixed $color, int $x, int $y, int $width, int $height): Image
    {
        foreach (range($x, $x + $width) as $left) {
            foreach (range($y, $y + $height) as $top) {
                $canvas->pixel($color, $left, $top);
            }
        }

        return $canvas;
    }

    /**
     * @param string|null $seed
     * @return string
     */
    public static function seed(string $seed = null): string
    {
        if ($seed == null) {
            $seed = base_convert(floor(Helpers::randomFloat(0, 1) * pow(10, 16)), 10, 16);
            $sqrt = sqrt(floatval($seed));

            if ($sqrt > 16 || $sqrt < 8) {
                return static::seed();
            }

            return $seed;
        }

        if (strlen($seed) < 8 || strlen($seed) > 16) {
            throw new InvalidArgumentException('Seed must be a minimum of 8 characters and a maximum of 16 characters.');
        }

        return $seed;
    }

    /**
     * @return Hsl
     */
    public static function randomColor(): Hsl
    {
        $h = rand(0, 360) / 360;
        $s = rand(40, 100) / 100;
        $l = (self::rand() + self::rand() + self::rand() + self::rand()) * 25 / 100;

        $h = round($h * 360);
        $s = round($s * 100);
        $l = round($l * 100);

        return new Hsl($h, $s, $l);
    }

    /**
     * @return float
     */
    public static function rand(): float
    {
        return mt_rand() / mt_getrandmax();
    }

    /**
     * @param int $min
     * @param int $max
     * @return float
     */
    public static function randomFloat(int $min, int $max): float
    {
        return rand($min, $max - 1) + (rand(0, PHP_INT_MAX - 1) / PHP_INT_MAX);
    }
}
