<?php
function randomGen(int $max = 20)
{
    for ($i = 0; $i < $max; $i++) {
        yield rand(0, 20);
    }
}

//$generator = randomGen(100);
//
//
//foreach ($generator as $key => $value) {
//    echo $key . ': ' . $value . PHP_EOL;
//}


// ----------------------------------------------------------------------

function sendTest()
{
    $smth = yield;
    while (true)
        $smth = yield $smth . 'A' . PHP_EOL;
}

//$test = sendTest();
//var_dump($test->send(111));
//var_dump($test->send('aaa'));
//var_dump($test->send('aga'));


// ----------------------------------------------------------------------
class testByRefGenerator implements  IteratorAggregate {
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function &getIterator()
    {
        foreach ($this->data as $key => &$value) {
            yield $key => $value;
        }
    }

    public  function getData() {
        return $this->data;
    }
}

//$arr = [1,2,3,4,5];
//$dataContainer = new testByRefGenerator($arr);
//
//var_dump($dataContainer->getData());
//foreach ($dataContainer as &$value) {
//    $value *= -1;
//}
//unset($value);
//var_dump($dataContainer->getData());
//
//foreach ($dataContainer as &$value) {
//    $value *= 2;
//}
//unset($value);
//var_dump($dataContainer->getData());

// ----------------------------------------------------------------------
//
function step1()
{
    $f = fopen("file0.txt", 'r');
    while ($line = fgets($f)) {
        echo $line;
        yield $line;
    }
}

function step2()
{
    $f = fopen("file1.txt", 'r');
    while ($line = fgets($f)) {
        yield $line;
    }
}

function step3()
{
    $f = fopen("file2.txt", 'r');
    while ($line = fgets($f)) {
        yield $line;
    }
}

$generatorA = step1();
$generatorB = step2();
$generatorC = step3();

//$both = new MultipleIterator();
//$both->attachIterator($generatorA);
//$both->attachIterator($generatorB);
//$both->attachIterator($generatorC);
//
//foreach ($both as list($valueA, $valueB,$valueC)) {
//    echo $valueA.$valueB.$valueC.PHP_EOL;
//}

// ----------------------------------------------------------------------
//$generatorA->rewind();
//while (true) {
//    var_dump($generatorA->current());
//    $generatorA->next();
//    if (!$generatorA->valid())
//        return;
//}