<?php


namespace IsaEken\Blockies;


use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Spatie\Color\Hsl;

class Blockies
{
    /**
     * @var Options $seed
     */
    private Options $options;

    /**
     * @var bool $drawn
     */
    private bool $drawn = false;

    /**
     * Blockies constructor.
     *
     * @param array|object|null $options
     */
    public function __construct(array|object|null $options = null)
    {
        $this->options = new Options($options);
    }

    /**
     * @return $this
     */
    public function refresh(): self
    {
        $this->options->seed = Helpers::seed();
        return $this;
    }

    /**
     * @return string
     */
    public function getSeed(): string
    {
        return $this->options->seed;
    }

    /**
     * @param string $seed
     * @return $this
     */
    public function setSeed(string $seed): self
    {
        $this->options->seed = $seed;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->options->size;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->options->size = $size;
        return $this;
    }

    /**
     * @return Hsl
     */
    public function getBackground(): Hsl
    {
        return $this->options->background;
    }

    /**
     * @param Hsl $background
     * @return $this
     */
    public function setBackground(Hsl $background): self
    {
        $this->options->background = $background;
        return $this;
    }

    /**
     * @return Blockies
     */
    public function draw(): self
    {
        $this->drawn = true;

        srand(hexdec(substr($this->options->seed, -10)));

        $colors = collect([
            Helpers::randomColor(),
            Helpers::randomColor(),
            Helpers::randomColor(),
        ]);

        $cell = $this->options->size / sqrt($this->options->size);

        for ($y = 0; $y < sqrt(floatval($this->options->seed)); $y++) {
            $values = [];
            for ($i = 0; $i < sqrt($this->options->size) / 2; $i++) {
                $values[] = floor(Helpers::rand() * 2.3);
            }
            $values = array_merge($values, array_reverse($values));
            $x = 0;

            foreach ($values as $value) {
                $this->options->rectangles->add(new Rectangle([
                    'x' => $x * $cell,
                    'y' => $y * $cell,
                    'width' => $cell,
                    'height' => $cell,
                    'color' => $colors->get(intval($value)),
                ]));

                $x += 1;
            }
        }

        srand();
        return $this;
    }

    /**
     * @return string
     */
    public function svg(): string
    {
        if (! $this->drawn) {
            return "";
        }

        $size = $this->options->size;
        $background = $this->options->background->toHex()->__toString();

        $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='$size' height='$size' style='background-color: $background'>";
        $svg .= "<g>";

        /** @var Rectangle $rectangle */
        foreach ($this->options->rectangles as $rectangle) {
            $x = $rectangle->getX();
            $y = $rectangle->getY();
            $width = $rectangle->getWidth();
            $height = $rectangle->getHeight();
            $color = $rectangle->getColor()->toHex()->__toString();

            if ($color == $this->options->background->toHex()->__toString()) {
                continue;
            }

            $svg .= "<rect x='$x' y='$y' width='$width' height='$height' style='fill: $color;'/>\r\n";
        }

        return $svg . "</g></svg>";
    }

    /**
     * @return Image
     */
    public function image(): Image
    {
        if (! $this->drawn) {
            return new Image;
        }

        $manager = new ImageManager();
        $canvas = $manager->canvas(
            $this->options->size,
            $this->options->size,
            $this->options->background->toHex()->__toString(),
        );

        /** @var Rectangle $rectangle */
        foreach ($this->options->rectangles->all() as $rectangle) {
            if ($rectangle->getColor()->toHex()->__toString() == $this->options->background->toHex()->__toString()) {
                continue;
            }

            $canvas = Helpers::drawBlockToCanvas(
                $canvas,
                $rectangle->getColor()->toHex()->__toString(),
                $rectangle->getX(),
                $rectangle->getY(),
                $rectangle->getWidth(),
                $rectangle->getHeight(),
            );
        }

        return $canvas;
    }
}
