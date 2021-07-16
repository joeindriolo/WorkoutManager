<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function my_autoloader($class) {
    include __DIR__ .'/'.$class .'.php';
}
spl_autoload_register('my_autoloader');


//i think its loading this before the session is made

$queue = $_SESSION["queue"];

$queue->rewind();
while($queue->valid()) {
    $workoutobject = unserialize($queue->current());
    print_r( $workoutobject->toString());
    echo "<br>";
    $queue->next();
}
