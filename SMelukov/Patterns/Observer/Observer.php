<?php
/**
 * @author  Sergey Melukov
 * @link    http://smelukov.com
 * @license MIT
 */
namespace SMelukov\Patterns\Observer;
/**
 * Trait Observer
 * Implements base methods of Observer, except trigger().
 *
 * trigger() method should be implemented in concrete Observer class
 *
 * @package SMelukov\Patterns\Observer
 */
trait Observer {
    /**
     * @see IObserver::subscribe()
     *
     * @param IObservable $observable
     * @param $eventName
     *
     * @return $this
     */
    function subscribe (IObservable $observable, $eventName)
    {
        $observable->addObserver($eventName, $this);
        return $this;
    }

    /**
     * @see IObserver::unsubscribe()
     *
     * @param IObservable $observable
     * @param $eventName
     *
     * @return $this
     */
    function unsubscribe (IObservable $observable, $eventName)
    {
        $observable->removeObserver($eventName, $this);
        return $this;
    }
}