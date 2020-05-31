<?php

namespace App;

class Manager
{
    public function place($item): void
    {
        switch (get_parent_class($item)) {
            case 'Papers':
                echo 'Положил ' . get_class($item) . ' на стол <br/>';
                break;
            case 'Instrument':
                echo 'Убрал ' . get_class($item) . ' внутрь стола <br/>';
                break;
            default:
                echo 'Выкинул ' . get_class($item) . ' в корзину <br/>';
        }
    }
}

abstract class Papers
{
}

abstract class Instrument
{
}

class Document extends Papers
{
}

class Drill extends Instrument
{
}

class Phone
{
}

class Instruction extends Papers
{
}

class Junk
{
}

echo '<a href="/">Вернуться на главную</a> <br/>';

$manager = new Manager();

$manager->place(new Document());
$manager->place(new Drill());
$manager->place(new Phone());
$manager->place(new Instruction());
$manager->place(new Junk());
