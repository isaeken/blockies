<?php


namespace IsaEken\Blockies;


use Illuminate\Support\Collection;
use Spatie\Color\Hsl;
use stdClass;

/**
 * Class Options
 *
 * @package IsaEken\Blockies
 * @property string $seed
 * @property int $size
 * @property Collection $rectangles
 * @property Hsl $background
 */
class Options
{
    /**
     * @var array $options
     */
    private $options = [];

    /**
     * Options constructor.
     *
     * @param array|object|null $options
     */
    public function __construct(array|object|null $options = [])
    {
        if (is_null($options)) {
            $options = new stdClass;
        }
        else if (is_array($options)) {
            $options = (object) $options;
        }

        $options->seed = Helpers::seed(isset($options->seed) ? (string) $options->seed : null);
        $options->size = $options->size ?? 64;
        $options->background = $options->background ?? new Hsl(0, 0, 0.94);
        $options->rectangles = $options->rectangles ?? new Collection;

        foreach ($options as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->options[$name] ?? null;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set(string $name, $value): void
    {
        $this->options[$name] = $value;
    }
}
