<?php

interface IObserver {
    function trigger ($eventName, $args);
}

trait Observervable {
    private $_observers = [];

    function observerExists ($eventName, IObserver $obs)
    {
        if ( isset($this->_observers[$eventName]) ) {
            foreach ( $this->_observers[$eventName] as $key => $val ) {
                if ( $val === $obs ) {
                    return $key;
                }
            }
        }
        return false;
    }

    function addObserver ($eventName, IObserver $obs)
    {
        if ( $this->observerExists($eventName, $obs) === false ) {
            $this->_observers[$eventName][] = $obs;
        }
    }

    function removeObserver ($eventName, IObserver $obs)
    {
        if ( ($index = $this->observerExists($eventName, $obs)) === false ) {
            unset($this->_observers[$eventName][$index]);
        }
    }

    function getEvents ()
    {
        $arr = [];
        foreach ( $this->_observers as $eName ) {
            $arr[] = $eName;
        }
        return $arr;
    }

    function getObservers ($eventName)
    {
        $arr = [];
        if ( isset($this->_observers[$eventName]) ) {
            foreach ( $this->_observers[$eventName] as $obs ) {
                $arr[] = $obs;
            }
        }
        return $arr;
    }

    function notyfy ($eventName, $args = [])
    {
        if ( isset($this->_observers[$eventName]) ) {
            /** @var IObserver $obs */
            foreach ( $this->_observers[$eventName] as $obs ) {
                $obs->trigger($eventName, $args);
            }
        }
    }
}

class Calculator {
    use Observervable;

    function calculate ($numbers)
    {
        $res = array_sum($numbers);
        $this->notyfy('calculate', [$res]);
        return $res;
    }
}

class Client implements IObserver {
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

$calc->calculate([
    1,
    1,
    1,
    1,
    1,
    1
]);

$calc->addObserver('some', $client3);
$calc->notyfy('some', [1000]);
