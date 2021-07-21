<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function my_autoloader($class) {
    include __DIR__ .'/'.$class .'.php';
}

spl_autoload_register('my_autoloader');
echo 'yaaaa';

session_start();


if(isset($_SESSION["queue"])) {
    echo "made";
    $queue = $_SESSION["queue"];
}else{
    $_SESSION["queue"]= new SplQueue();
    $queue= $_SESSION["queue"];
    echo "not made";
}


$exercise=null;
$number=null;
$type=null;
$repAmount=null;
$lbs=null;

if(isset($_POST["exer"])) {
    echo 'forwei';
    $exercise = $_POST["exer"];
    $number = $_POST["number"];
    $type = $_POST["type"];
    if($type=="Sets") {
        $repAmount= $_POST['reps'];
    }
    if(isset($_POST["lbs"])) $lbs=$_POST["lbs"];
    //dont check issset check if it is equal to number or not

    //not declaring lbs as null when it is
    if(is_null($repAmount) && is_null($lbs)) {
        $queue->push(serialize(new WorkoutObject($exercise,$number,$type)));
        echo 'lbs null';
    }
    else if(is_null($repAmount) && !is_null($lbs)) {
        $queue->push(serialize(new WorkoutObject($exercise,$number,$type,$lbs)));
        echo 'lbs not null';
    }
    else if(!is_null($repAmount) && !is_null($lbs)) {
        $queue->push(serialize(new WorkoutObject($exercise,$number,$type,$repAmount,$lbs)));
    }

    $queue->rewind();
    while($queue->valid()) {
        $workoutobject = unserialize($queue->current());
        print_r( $workoutobject->toString());
        echo "<br>";
        $queue->next();
    }
}

echo 'forwei';


