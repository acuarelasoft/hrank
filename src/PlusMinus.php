<?php

namespace App;

class PlusMinus
{
    public function plusMinus(array $arr)
    {
        $n = count($arr);
        $decimals = 6;

        $positive = count(array_filter($arr, fn ($number) => $number > 0));
        $negative = count(array_filter($arr, fn ($number) => $number < 0));
        $zero = count(array_filter($arr, fn ($number) => $number == 0));

        $ratio_positive = number_format($positive / $n, $decimals);
        $ratio_negative = number_format($negative / $n, $decimals);
        $ratio_zero = number_format($zero / $n, $decimals);

        echo $ratio_positive . "\n";
        echo $ratio_negative . "\n";
        echo $ratio_zero . "\n";

        return [$ratio_positive, $ratio_negative, $ratio_zero];
    }
}
