<?php
namespace SMelukov\Patterns\Observer;
trait Observable {
    private $_observers = [];

    function addObserver ($eventName, IObserver $obs)
    {
        if ( $this->observerExists($eventName, $obs) === false ) {
            $this->_observers[$eventName][] = $obs;
        }
    }

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

    function notify ($eventName, $args = [])
    {
        if ( isset($this->_observers[$eventName]) ) {
            /** @var IObserver $obs */
            foreach ( $this->_observers[$eventName] as $obs ) {
                $obs->trigger($eventName, $args);
            }
        }
    }
}