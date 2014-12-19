<?php
namespace SMelukov\Patterns\Observer;
/**
 * Trait Observable
 * Implements base methods of Observable.
 *
 * @package SMelukov\Patterns\Observer
 */
trait Observable {
    /**
     * @var array observers storage
     */
    private $_observers = [];

    /**
     * @see IObservable::addObserver()
     *
     * @param $eventName
     * @param IObserver $obs
     *
     * @return $this
     */
    function addObserver ($eventName, IObserver $obs)
    {
        if ( $this->observerExists($eventName, $obs) === false ) {
            $this->_observers[$eventName][] = $obs;
        }
        return $this;
    }

    /**
     * @see IObservable::observerExists()
     *
     * @param $eventName
     * @param IObserver $obs
     *
     * @return bool|int|string
     */
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

    /**
     * @see IObservable::removeObserver()
     *
     * @param $eventName
     * @param IObserver $obs
     *
     * @return $this
     */
    function removeObserver ($eventName, IObserver $obs)
    {
        if ( ($index = $this->observerExists($eventName, $obs)) === false ) {
            unset($this->_observers[$eventName][$index]);
        }
        return $this;
    }

    /**
     * @see IObservable::getEvents()
     *
     * @return array
     */
    function getEvents ()
    {
        return array_keys($this->_observers);
    }

    /**
     * @see IObservable::getObservers()
     *
     * @param $eventName
     *
     * @return array
     */
    function getObservers ($eventName)
    {
        return isset($this->_observers[$eventName]) ? $this->_observers[$eventName] : [];
    }

    /**
     * @see IObservable::notify()
     *
     * @param $eventName
     * @param array $args
     *
     * @return $this
     */
    function notify ($eventName, $args = [])
    {
        if ( isset($this->_observers[$eventName]) ) {
            /** @var IObserver $obs */
            foreach ( $this->_observers[$eventName] as $obs ) {
                $obs->trigger($eventName, $args);
            }
        }
        return $this;
    }
}