<?php

$array = [];
for ($i = 0; $i <= 100; $i++) {
    $array[$i] = 28 * rand(1, 100);
}

//print_r($array);

function bsearch(array $arr, int $searchVal)
{
    $min = 0;
    $max = count($arr) - 1;
    while ($min <= $max) {
        $mid = floor(($min + $max) / 2);
        $guess = $arr[$mid];
        if ($guess === $searchVal)
            return $mid;
        if ($guess < $searchVal)
            $min = $mid + 1;
        elseif ($guess > $searchVal)
            $max = $mid - 1;
    }
    return NULL;
}

function findSmallest(array $arr) : int
{
    $smallestInd = 0;
    $el = $arr[$smallestInd];
    for ($i = 0; $i < count($arr); $i++) {
        if ($arr[$i] < $el) {
            $smallestInd = $i;
            $el = $arr[$i];
        }
    }
    return $smallestInd;
}

function selectionSort(array $arr) : array
{
    $new_arr = [];
    $end = count($arr);
    for ($i = 0; $i < $end; $i++) {
        $smallestInd = findSmallest($arr);
        $new_arr[] = $arr[$smallestInd];
        array_splice($arr, $smallestInd, 1);
    }
    return $new_arr;
}

//print_r(selectionSort($array));


function test(array $array) : void
{
    $res_ar_s_array = [];
    $res_bin_s_array = [];
    $miracle_arr = [];

    for ($i = 0; $i <= 1000; $i++) {
        $time = hrtime(true);
        var_dump(array_search(2100, selectionSort($array)));
        $endtime = hrtime(true);
        $res_ar_s = $endtime - $time;

        $btime = hrtime(true);
        var_dump(bsearch(selectionSort($array), 2100));
        $bendtime = hrtime(true);
        $res_bin_s = $bendtime - $btime;

        if ($res_ar_s > $res_bin_s)
            $res_ar_s_array[] = 0;
        elseif ($res_ar_s < $res_bin_s)
            $res_bin_s_array[] = 1;
        else
            $miracle_arr[] = 'MAGIC!';
    }
    if (count($res_bin_s_array) > count($res_ar_s_array))
        echo 'Binary_wins' . PHP_EOL;
    else
        echo 'Array_search wins' . PHP_EOL;

    var_dump($miracle_arr);
}
//var_dump(findSmallest($array));
test($array);