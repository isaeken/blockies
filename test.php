<?php

require_once __DIR__ . '/vendor/autoload.php';

$blockies = new \IsaEken\Blockies\Blockies([
//    'seed' => '121aee714ecaff'
]);
//$blockies->setSeed();

$data=[];

foreach (range(0, 11) as $image) {
    $blockies->refresh()->draw()->image()->save(__DIR__ . '/images/' . $blockies->getSeed() . '.jpeg');
}

//file_put_contents(__DIR__ . '/tests/images.json', json_encode($data, JSON_PRETTY_PRINT));
