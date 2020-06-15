<?php

$a = [
    100 => 'aaa',
    -100 => 'ccc'
];

$b = 1;

$a[] = 'bbb';


//var_dump($b[1]);

class A {
    private $A;
}

class B extends A {
    private $A;
    public $AA;
}

//var_dump((array) new B());

$arr = range(2,'Z');

var_dump($arr);