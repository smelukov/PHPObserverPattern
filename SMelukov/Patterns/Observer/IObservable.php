<?php
namespace SMelukov\Patterns\Observer;
/**
 * Interface IObservable
 * Describes base Observable functionality
 *
 * @package SMelukov\Patterns\Observer
 */
interface IObservable {
    /**
     * Check existence of Observer on concrete event
     *
     * @param $eventName
     * @param IObserver $obs
     *
     * @return mixed
     */
    function observerExists ($eventName, IObserver $obs);

    /**
     * Add new Observer
     *
     * @param $eventName
     * @param IObserver $obs
     *
     * @return mixed
     */
    function addObserver ($eventName, IObserver $obs);

    /**
     * Remove Observer
     *
     * @param $eventName
     * @param IObserver $obs
     *
     * @return mixed
     */
    function removeObserver ($eventName, IObserver $obs);

    /**
     * Get events list on this Observable
     *
     * @return mixed
     */
    function getEvents ();

    /**
     * Get Observer list by event name
     *
     * @param $eventName
     *
     * @return mixed
     */
    function getObservers ($eventName);

    /**
     * Notify to all Observers by concrete event
     *
     * @param $eventName
     * @param array $args arguments which will be passed to trigger() method on Observer
     *
     * @return mixed
     */
    function notify ($eventName, $args = []);
}