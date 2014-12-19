<?php
namespace SMelukov\Patterns\Observer;
/**
 * Interface IObserver
 * Describes base Observer functionality
 *
 * @package SMelukov\Patterns\Observer
 */
interface IObserver {
    /**
     * Method which will be called after notifying from Observable by concrete event
     *
     * @param $eventName
     * @param array $args arguments which will be got from triggered event
     *
     * @return mixed
     */
    function trigger ($eventName, $args);

    /**
     * Subscribe on event of Observable
     *
     * @param IObservable $observable
     * @param $eventName
     *
     * @return mixed
     */
    function subscribe (IObservable $observable, $eventName);

    /**
     * Unsubscribe from event of Observable
     *
     * @param IObservable $observable
     * @param $eventName
     *
     * @return mixed
     */
    function unsubscribe (IObservable $observable, $eventName);
}