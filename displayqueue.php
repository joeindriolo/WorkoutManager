<?php
function my_autoloader($class) {
    include __DIR__ .'/'.$class .'.php';
}
spl_autoload_register('my_autoloader');

//i think its loading this before the session is made

session_start();
$queue = $_SESSION["queue"];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$queue->rewind();
while($queue->valid()) {
    echo $queue->current()->toString();
    echo "<br>";
    $queue->next();
}
