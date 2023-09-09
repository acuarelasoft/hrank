<?php

test('Plus Minus', function ($arr, $expected) {
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


test('Mini-Max Sum', function ($arr, $expected) {
    sort($arr);

    $min_sum = array_sum(array_slice($arr, 0, 4));
    $max_sum = array_sum(array_slice($arr, -4));

    $result = "$min_sum $max_sum";
    echo $result . "\n";
    expect($result)->toEqual($expected);
})->with([
    [[1, 3, 5, 7, 9], "16 24"],
]);


test('Time Conversion', function ($input, $expected) {
    $result = date('H:i:s', strtotime($input));

    expect($result)->toEqual($expected);
})->with([
    ['12:01:00PM', '12:01:00'],
    ['12:01:00AM', '00:01:00'],
    ['07:05:45PM', '19:05:45'],
]);

test('Breaking the Records', function ($scores, $expected) {
    $min_score = null;
    $max_score = null;

    $count_min = 0;
    $count_max = 0;

    foreach ($scores as $score) {
        if ($min_score === null && $max_score === null) {
            $min_score = $score;
            $max_score = $score;
            continue;
        }

        if ($score < $min_score) {
            $min_score = $score;
            $count_min++;
        }

        if ($score > $max_score) {
            $max_score = $score;
            $count_max++;
        }
    }

    $result = [$count_max, $count_min];

    expect($result)->toEqual($expected);
})->with([
    [[10, 5, 20, 20, 4, 5, 2, 25, 1], [2, 4]],
    [[0, 9, 3, 10, 2, 20], [3, 0]]
]);

test('Camel Case 4', function ($input, $expected) {
    // S for split
    // C for combine
    // M for method
    // C for class
    // V for variable

    // split string by lines


    [$command, $type, $value] = explode(';', $input);

    $result = '';

    if ($command === 'S') {
        $matches = null;
        if (preg_match_all('/[A-Za-z][a-z]*/', $value, $matches)) {
            $result = implode(' ', array_map('strtolower', $matches[0]));
        }
    }

    if ($command === 'C') {
        $words = explode(' ', $value);

        if ($type === 'V' || $type === 'M') {
            $first_word = strtolower($words[0]);
            $all_words_but_first = array_map('ucfirst', array_splice($words, 1));
            $result = implode('', array_merge([$first_word], $all_words_but_first));

            if ($type === 'M') {
                $result .= '()';
            }
        }

        if ($type === 'C') {
            $result = implode('', array_map('ucfirst', $words));
        }
    }

    expect($result)->toEqual($expected);
})->with([
    ['S;M;plasticCup()', 'plastic cup'],
    ['C;V;mobile phone', 'mobilePhone'],
    ['C;C;coffee machine', 'CoffeeMachine'],
    ['S;C;LargeSoftwareBook', 'large software book'],
    ['C;M;white sheet of paper', 'whiteSheetOfPaper()'],
    ['S;V;pictureFrame', 'picture frame'],
    ['S;V;iPad', 'i pad'],
    ['C;M;mouse pad', 'mousePad()'],
    ['C;C;code swarm', 'CodeSwarm'],
    ['S;C;OrangeHighlighter', 'orange highlighter']
]);
