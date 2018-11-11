<?php
/**
 * Created by PhpStorm.
 * User: Ruslan
 * Date: 11.11.2018
 * Time: 14:29
 */

/**
 * @param $sortObj
 * @return array
 */
function quick_sort($sortObj) {
    $arr = $sortObj['arr']; //Не считаем
    $steps = $sortObj['steps'];//Не считаем
    $count = count($arr); //O(1)

    $steps++;

    if ($count <= 1) {//O(1)
        return [
            'arr' => $arr,
            'steps' => $steps + 1
        ];
    }

    $steps++;

    $first = $arr[0];//O(1)
    $left_arr = [];//O(1)
    $right_arr = [];//O(1)

    $steps+=3;

    for ($i = 1; $i < $count; $i++) {//O($count - 1)
        if ($arr[$i] <= $first) {
            array_push($left_arr, $arr[$i]);
        } else {
            array_push($right_arr, $arr[$i]);
        }
    }

    $steps+=$count - 1;

    $left_arr = quick_sort([//O(1)
        'arr' => $left_arr,
        'steps' => $steps
    ]);

    $right_arr = quick_sort([//O(1)
        'arr' => $right_arr,
        'steps' => $left_arr['steps']
    ]);

    return [
        'arr' => array_merge($left_arr['arr'], array($first), $right_arr['arr']),
        'steps' => $right_arr['steps'] + 2
    ];
}

/**
 * @param $count
 * @return array
 */
function getArray($count) {
    $arr = [];
    for ($i = 0; $i < $count; $i++) {
        array_push($arr, rand(-100, 100));
    }

    return $arr;
}

define('COUNT', 100);

$testObj = [
    'arr' => getArray(COUNT),
    'steps' => 0,
];

?>

<h2>Оценка сложности алгоритма быстрой сортировки</h2>
<pre>
    <b>Элементов в массиве: <?= COUNT ?>. Шагов в алгоритме: <?= quick_sort($testObj)['steps']?></b>
</pre>
