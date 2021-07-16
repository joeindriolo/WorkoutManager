<?php

function my_autoloader($class) {
    include __DIR__ .'/'.$class .'.php';
}

spl_autoload_register('my_autoloader');


session_start();


if(isset($_SESSION["queue"])) {
    echo "made";
    $queue = $_SESSION["queue"];
}else{
    $_SESSION["queue"]= new SplQueue();
    $queue= $_SESSION["queue"];
    echo "not made";
}
/*
$name= "queue";
if(!isset($_COOKIE[$name])) {
    setcookie($name, new SplQueue(),'/');
    $queue = $_COOKIE[$name];
    echo "new";
}else{
    $queue = $_COOKIE[$name];
}
*/

//do the cookie here


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$exercise=null;
$number=null;
$type=null;
$repAmount=null;
$lbs=null;



//need to get the queue to be initalized once, and called later so it does not reset every time we submit the form

if(isset($_POST["exer"])) {
    $exercise = $_POST["exer"];
    $number = $_POST["number"];
    $type = $_POST["type"];
    if($type=="Sets") {
        $repAmount= $_POST['reps'];
    }
    if(isset($_POST["lbs"])) $lbs=$_POST["lbs"];

    if(is_null($repAmount) && is_null($lbs)) {
        $queue->push(new WorkoutObject($exercise,$number,$type));
    }
    else if(is_null($repAmount) && !is_null($lbs)) {
        $queue->push(new WorkoutObject($exercise,$number,$type,$lbs));
    }
    else if(!is_null($repAmount) && !is_null($lbs)) {
        $queue->push(new WorkoutObject($exercise,$number,$type,$repAmount,$lbs));
    }

    $queue->rewind();
    while($queue->valid()) {
        echo $queue->current()->toString();
        echo "<br>";
        $queue->next();
    }
}
