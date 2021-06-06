# PHP Blockies

The php alternative for [download13/blockies](https://github.com/download13/blockies) js package.

![isaeken/blockies](images/1.jpeg)
![isaeken/blockies](images/2.jpeg)
![isaeken/blockies](images/3.jpeg)
![isaeken/blockies](images/4.jpeg)
![isaeken/blockies](images/5.jpeg)
![isaeken/blockies](images/6.jpeg)
![isaeken/blockies](images/7.jpeg)
![isaeken/blockies](images/8.jpeg)
![isaeken/blockies](images/9.jpeg)
![isaeken/blockies](images/10.jpeg)
![isaeken/blockies](images/11.jpeg)
![isaeken/blockies](images/12.jpeg)

````php
$blockies = new \IsaEken\Blockies\Blockies;
$blockies->draw();

echo $blockies->svg(); // <svg...
$blockies->image()->save('image.jpg'); // save generated image
echo $blockies->image()->encode('data-url')->encoded; // data:image/png;base64...
````

## Installation

You can install with using composer.

````shell
composer require isaeken/blockies
````

## Usage

Create the instance first.

````php
$blockies = new \IsaEken\Blockies\Blockies([
    'seed' => '130ef2f0a8b713',
    'size' => 64,
    'background' => \Spatie\Color\Hex::fromString('#ff0000')->toHsl(),
]);

// or

$blockies = new \IsaEken\Blockies\Blockies;
````

draw them.

````php
$blockies->draw();
````

You can use this as SVG.

````php
file_put_contents('image.svg', $blockies->svg());
````

or use this with Intervention\Image

````php
$blockies->image()->greyscale()->save('black_and_white.jpg');
````

recreate your seed

````php
$blockies->refresh();
$blockies->image(); // this is a new image.
````

resize and change background

````php
$blockies
    ->setSize(120)
    ->setBackground(\Spatie\Color\Hex::fromString('#00ff00')->toHsl())
    ->draw()
    ->image();
````

change seed

````php
$blockies->setSeed('130ef2f0a8b713')->draw()->image();
````

get values

````php
$blockies->getSeed(); // string
$blockies->getBackground(); // \Spatie\Color\Hsl
$blockies->getSize(); // int
````

## Testing

````shell
composer test
````

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
