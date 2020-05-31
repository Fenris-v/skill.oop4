<?php

namespace App;

abstract class Item
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function show()
    {
        echo 'Я ' . $this->name . '<br/>';
    }
}

class EmptyItem extends Item
{
    public function show()
    {
        echo 'Класс ' . $this->name . ' не найден <br/>';
    }
}

class Creator {
    public static array $config;

    public function __construct()
    {
        self::$config = [
            'cat' => '\App\Cat',
            'dog' => '\App\Dog',
            'horse' => '\App\Horse',
            'wolf' => '\App\Wolf',
            'newspaper' => '\App\Newspaper',
            'computer' => '\App\Computer',
            'programmer' => '\App\Programmer',
            'headphones' => '\App\Headphones',
            'charge' => '\App\Charge',
            'justItem' => '\App\JustItem',
            'empty' => '\App\EmptyItem'
        ];
    }

    public static function create(string $name): Item
    {
        if (key_exists($name, self::$config) && class_exists(self::$config[$name])) {
            return new self::$config[$name]($name);
        } else {
            return new self::$config['empty']($name);
        }
    }
}

class Cat extends Item
{
}

class Dog extends Item
{
}

class Horse extends Item
{
}

class Wolf extends Item
{
}

class Newspaper extends Item
{
}

class Computer extends Item
{
}

class Programmer extends Item
{
}

class Headphones extends Item
{
}

class Charge extends Item
{
}

class JustItem extends Item
{
}

echo '<a href="/">Вернуться на главную</a> <br/>';

$creator = new Creator();

foreach ($creator::$config as $key => $item) {
    $creator::create($key)->show();
}

$creator::create('junk')->show();
