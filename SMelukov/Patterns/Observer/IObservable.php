<?php
namespace SMelukov\Patterns\Observer;
interface IObservable {
    function observerExists ($eventName, IObserver $obs);

    function addObserver ($eventName, IObserver $obs);

    function removeObserver ($eventName, IObserver $obs);

    function getEvents ();

    function getObservers ($eventName);

    function notyfy ($eventName, $args = []);
}