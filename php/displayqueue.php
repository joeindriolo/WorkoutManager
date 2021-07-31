<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

include_once 'WorkoutObject.php';
session_start();

echo "<div class='queuecontent' id='queuecontent'>";
$queue = $_SESSION["queue"];
if(is_null($queue)) {
    echo 'Empty queue';
}else{
    $queue = $_SESSION["queue"];
    $queue->rewind();
    while($queue->valid()) {
        $workoutobject = unserialize($queue->current());
        if(!is_null($workoutobject)) print_r($workoutobject->toString());
        echo "<br>";
        $queue->next();
    }
}
echo "</div>";

