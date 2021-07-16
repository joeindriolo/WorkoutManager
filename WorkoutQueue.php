<?php

class WorkoutQueue
{
    public static $queue;
    public static function setQueue() {
        WorkoutQueue::$queue= new SplQueue();
    }

    public static function getQueue() {
        return WorkoutQueue::$queue;
    }
}
