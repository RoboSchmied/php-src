--TEST--
Observer: Generator with explicit return
--EXTENSIONS--
zend_test
--INI--
zend_test.observer.enabled=1
zend_test.observer.show_output=1
zend_test.observer.observe_all=1
zend_test.observer.show_return_value=1
--FILE--
<?php
function getResults() {
    for ($i = 10; $i < 13; $i++) {
        yield $i;
    }
    return 1337;
}

function doSomething() {
    $generator = getResults();
    foreach ($generator as $value) {
        echo $value . PHP_EOL;
    }
    echo $generator->getReturn() . PHP_EOL;

    return 'Done';
}

echo doSomething() . PHP_EOL;
?>
--EXPECTF--
<!-- init '%s' -->
<file '%s'>
  <!-- init doSomething() -->
  <doSomething>
    <!-- init getResults() -->
    <getResults>
    </getResults:10>
10
    <getResults>
    </getResults:11>
11
    <getResults>
    </getResults:12>
12
    <getResults>
    </getResults:1337>
    <!-- init Generator::getReturn() -->
    <Generator::getReturn>
    </Generator::getReturn:1337>
1337
  </doSomething:'Done'>
Done
</file '%s'>
