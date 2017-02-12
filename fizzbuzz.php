// PHP5 >= 5.5
$params = range(1, 100);

$fizzbuzz_filter = function ($bool, $str) {
    if(filter_var($bool, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
        return $str;
    }
    return "";
};

$fizz = function ($param) use ($fizzbuzz_filter){
    return $fizzbuzz_filter($param % 3 === 0, "fizz");
};

$buzz = function ($param) use ($fizzbuzz_filter) {
    return $fizzbuzz_filter($param % 5 === 0, "buzz");
};

$fizzbuzz = function ($param) use ($fizz, $buzz)  {
    $ret = $fizz($param) . $buzz($param);
    if (empty($ret)) {
        $ret = $param;
    }
    return $ret;
};

$call = function ($params) use ($fizzbuzz) {
    foreach ($params as $param) {
        yield $fizzbuzz($param);
    }
};

foreach ($call($params) as $value) {
    print $value. PHP_EOL;
};