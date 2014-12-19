<?php
namespace SMelukov\Patterns\Observer;
trait Observer {
    function subscribe (IObservable $observable, $eventName)
    {
        $observable->addObserver($eventName, $this);
    }

    function unsubscribe (IObservable $observable, $eventName)
    {
        $observable->removeObserver($eventName, $this);
    }
}