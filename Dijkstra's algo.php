<?php

$graph['start'] = ['A' => 5,'B' => 1];
$graph['A'] = ['AA' => 20, 'AB' => 15, 'AC' => 10];
$graph['B'] = ['BA' => 5, 'BB' => 3];
$graph['AA'] = ['finish' => 15];
$graph['AB'] = ['AC' => 10,'BA' => 3];
$graph['AC'] = ['X' => 10];
$graph['BA'] = ['AA' => 2, 'finish' => 35];
$graph['BB'] = ['X' => 23];
$graph['X'] = ['finish' => 5];
$graph['finish'] = null;

$costs = [];
$parents = [];
$processed = [];

foreach ($graph as $key =>$value) {
    if ($key !== 'start') {
        if (!in_array($key,array_keys($graph['start']))) {
            $parents[$key] = NULL;
            $costs[$key] = INF;
        } else {
            $costs[$key] = $graph['start'][$key];
            $parents[$key] = 'start';
        }
    }
}

function getClosest($costs,$processed) {
    $unprocessed_costs = array_diff_key($costs,array_flip($processed));
    return array_keys($unprocessed_costs,min($unprocessed_costs))[0];
}


$node = getClosest($costs, $processed);
while ($node) {
    $node_cost = $costs[$node];
    foreach ($graph[$node] as $key => $value) {
        $new_cost = $node_cost + $value;
        if ($new_cost < $costs[$key]) {
            $costs[$key] = $new_cost;
            $parents[$key] = $node;
        }
    }
    $processed[] = $node;
    $node = getClosest($costs, $processed);
}
