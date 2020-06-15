<?php

$array = [];
for ($i=0;$i<20;$i++) {
    $array[$i] = rand(0,20);
}

function sum (array $arr) : int
{
    if (count($arr) < 2)
        return $arr[0];
    $cur_el = array_splice($arr,0,1);
    return $cur_el[0] + sum($arr);
}


function searchMax (array $arr) : int
{
    if (count($arr) < 2)
        return $arr[0];
    $cur_el = array_splice($arr,0,1);
    if ($cur_el[0] > $arr[0])
        array_splice($arr,0,1);
    else
        $cur_el[0] = searchMax($arr);
    return $cur_el[0];
}


//var_dump(sum($array));
//echo PHP_EOL;
//var_dump(searchMax($array));

function quicksort (array $arr) : array
{
    if (count($arr) < 2)
        return $arr;
    $cur_el = array_splice($arr,rand(0,count($arr)-1),1);
    $less = [];
    $greater = [];
    for ($i=0;$i<count($arr);$i++) {
        if ($arr[$i] <= $cur_el[0])
            $less[] = $arr[$i];
        else
            $greater[] = $arr[$i];
    }
    return array_merge(quicksort($less),$cur_el,quicksort($greater));
}
//var_dump($array);
//  var_dump(quicksort($array));

