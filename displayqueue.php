<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//i think its loading this before the session is made
echo "<div id='queuecontent class='queuecontent'>";
$queue = $_SESSION["queue"];
if(is_null($queue)) {
    echo 'Empty queue';
}else{
    $queue = $_SESSION["queue"];
    $queue->rewind();
    while($queue->valid()) {
        $workoutobject = unserialize($queue->current());
        print_r($workoutobject->toString());
        echo "<br>";
        $queue->next();
    }
}
echo "</div>";

//try to just make this part refresh and not the rest..
