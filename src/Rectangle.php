<?php


namespace IsaEken\Blockies;


use Spatie\Color\Hsl;

class Rectangle
{
    /**
     * @var int $x
     */
    private int $x;

    /**
     * @var int $y
     */
    private int $y;

    /**
     * @var int $width
     */
    private int $width;

    /**
     * @var int $height
     */
    private int $height;

    /**
     * @var Hsl $color
     */
    private Hsl $color;

    /**
     * Rectangle constructor.
     * 
     * @param array|object $options
     */
    public function __construct(array|object $options = [])
    {
        if (is_array($options)) {
            $options = (object) $options;
        }

        foreach ($options as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @return Hsl
     */
    public function getColor(): Hsl
    {
        return $this->color;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param Hsl $color
     * @return Rectangle
     */
    public function setColor(Hsl $color): self
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @param int $height
     * @return Rectangle
     */
    public function setHeight(int $height): self
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param int $width
     * @return Rectangle
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param int $x
     * @return Rectangle
     */
    public function setX(int $x): self
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @param int $y
     * @return Rectangle
     */
    public function setY(int $y): self
    {
        $this->y = $y;
        return $this;
    }
}
