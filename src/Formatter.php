<?php

namespace App;

interface Renderable
{
    public function render(string $string): void;
}

interface Formatter
{
    public function format(string $string): void;
}

class Display
{
    public static function show(?object $formatter, string $string): void
    {
        if ($formatter instanceof Renderable) {
            $formatter->render($string);
        } elseif ($formatter instanceof Formatter) {
            $formatter->format($string);
        } elseif (!is_subclass_of($formatter, Formatter::class) && method_exists($formatter, 'format')) {
            $formatter->format($string);
        } else {
            echo $string;
        }
    }
}

class NewRenderable implements Renderable
{
    public function render(string $string): void
    {
        echo '<p style="color: red;">' . $string . '</p>';
    }
}

class NewFormatter implements Formatter
{
    public function format(string $string): void
    {
        echo mb_strtoupper($string) . '<br>';
    }
}

class JustFormatter
{
    public function format($string)
    {
        $array = preg_split('//u', $string, null, PREG_SPLIT_NO_EMPTY);
        echo implode(' + ', $array) . '<br/>';
    }
}

echo '<a href="/">Вернуться на главную</a> <br/>';

$strArr = [
    'большой',
    'набор',
    'каких-то',
    'строк'
];

$display = new Display();

$newRenderable = new NewRenderable();
$newFormatter = new NewFormatter();
$justFormatter = new JustFormatter();

foreach ($strArr as $item) {
    $display::show($newRenderable, $item);
    $display::show($newFormatter, $item);
    $display::show($justFormatter, $item);
    $display::show(null, $item);
}
