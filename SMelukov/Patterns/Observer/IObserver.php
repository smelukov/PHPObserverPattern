<?php
namespace SMelukov\Patterns\Observer;
interface IObserver {
    function trigger ($eventName, $args);

    function subscribe (IObservable $observable, $eventName);

    function unsubscribe (IObservable $observable, $eventName);
}