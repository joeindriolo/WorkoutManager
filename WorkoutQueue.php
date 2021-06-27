<?php

class WorkoutQueue
{
    public static $queue;
    function __construct() {
        $this->queue= new SplQueue();
    }
}
