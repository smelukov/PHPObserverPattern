<?php
require_once 'autoloader.php';
use SMelukov\Patterns\Observer;

class Calculator implements Observer\IObservable {
    use Observer\Observable;

    function calculate ($numbers)
    {
        $res = array_sum($numbers);
        $this->notify('calculate', [$res]);
        return $res;
    }
}

class Client implements Observer\IObserver {
    use Observer\Observer;

    function trigger ($eventName, $args)
    {
        echo "$eventName => $args[0]";
    }
}

$client  = new Client();
$client2 = new Client();
$client3 = new Client();
$calc    = new Calculator();

$calc->addObserver('calculate', $client);
$calc->addObserver('calculate', $client2);
$calc->addObserver('some', $client3);

/* OR
$client->subscribe($calc, 'calculate');
$client2->subscribe($calc, 'calculate');
$client3->subscribe($calc, 'some');
*/

$calc->calculate([
    1,
    1,
    1,
    1,
    1,
    1
]);

$calc->notify('some', [1000]);