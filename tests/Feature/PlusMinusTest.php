<?php

use App\PlusMinus;

test('calculate the ratios of its elements', function ($arr, $expected) {
    expect((new PlusMinus)->plusMinus($arr))->toEqual($expected);
})->with([
    [[1, 1, 0, -1, -1], [0.400000, 0.400000, 0.200000]],
    [[-4, 3, -9, 0, 4, 1], [0.500000, 0.333333, 0.166667]],
]);
