<?php

$graph['me'] = ['bob','claire','andrew'];
$graph['bob'] = ['oleg','butterfly','huan-huan','Nazi8'];
$graph['claire'] = ['kesha','naker','butterfly'];
$graph['andrew'] = ['oleg','kesha','ququ'];
$graph['butterfly'] = ['shlepochek1488'];
$graph['oleg'] = [];
$graph['huan-huan'] = [];
$graph['kesha'] = [];
$graph['naker'] = [];
$graph['ququ'] = [];
$graph['shlepochek1488'] = [];
$graph['Nazi8'] = [];

function addArrayItemsToQueue (SplQueue $queue,array $arr): void
{
    foreach ($arr as $item) {
        $queue[] = $item;
    }
}


function isPersonNazi(string $name = '') : bool
{
    $naziArr = ['1488', 'Hitler', 'Nazi'];
    foreach ($naziArr as $item) {
        if (!(strpos($name,$item) === false))
        return true;
    }
    return false;
}

function breadthFirstSearch(SplQueue $deque,array $graph) : bool
{
    $searched = [];
    while (!$deque->isEmpty()) {
        $current = $deque->dequeue();
        if (in_array($current,$searched))
            continue;
        if (isPersonNazi($current)) {
            echo 'Nazi found: '.$current;
            return true;
        } else
            addArrayItemsToQueue($deque, $graph[$current]);
        $searched[] = $current;
    }
    return false;
}


$search_deque = new SplQueue();

addArrayItemsToQueue($search_deque,$graph['me']);

breadthFirstSearch($search_deque,$graph);
