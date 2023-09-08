<?php

test('calculate the ratios of its elements', function ($arr, $expected) {
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

    $result = [$ratio_positive, $ratio_negative, $ratio_zero];

    expect($result)->toEqual($expected);
})->with([
    [[1, 1, 0, -1, -1], [0.400000, 0.400000, 0.200000]],
    [[-4, 3, -9, 0, 4, 1], [0.500000, 0.333333, 0.166667]],
]);


test('find the minimum and maximum values that can be calculated by summing exactly four of the five integers', function ($arr, $expected) {
    sort($arr);

    $min_sum = array_sum(array_slice($arr, 0, 4));
    $max_sum = array_sum(array_slice($arr, -4));

    $result = "$min_sum $max_sum";
    echo $result . "\n";
    expect($result)->toEqual($expected);
})->with([
    [[1, 3, 5, 7, 9], "16 24"],
]);


test('time conversion 24 12', function ($input, $expected) {
    $result = date('H:i:s', strtotime($input));

    expect($result)->toEqual($expected);
})->with([
    ['12:01:00PM', '12:01:00'],
    ['12:01:00AM', '00:01:00'],
    ['07:05:45PM', '19:05:45'],
]);
