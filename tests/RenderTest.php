<?php

namespace IsaEken\Blockies\Tests;

use IsaEken\Blockies\Blockies;
use PHPUnit\Framework\TestCase;

class RenderTest extends TestCase
{
    public function testSeeds()
    {
        $images = json_decode(file_get_contents(__DIR__ . '/images.json'));
        $blockies = new Blockies;

        foreach ($images as $image) {
            $render = $blockies->setSeed($image->seed)->draw();
            $this->assertEquals($image->image->encoded, $render->image()->encode('data-url')->encoded);
            $this->assertEquals($image->svg, $render->svg());
        }
    }
}
