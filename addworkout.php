<?php
require 'WorkoutObject.php';
require 'WorkoutQueue.php';

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
        $GLOBALS['queue']->push(new WorkoutObject($exercise,$number,$type));
    }
    else if(is_null($repAmount) && !is_null($lbs)) {
        $GLOBALS['queue']->push(new WorkoutObject($exercise,$number,$type,$lbs));
    }
    else if(!is_null($repAmount) && !is_null($lbs)) {
        $GLOBALS['queue']->push(new WorkoutObject($exercise,$number,$type,$repAmount,$lbs));
    }

    $GLOBALS['queue']->rewind();
    while($GLOBALS['queue']->valid()) {
        echo $GLOBALS['queue']->current()->toString();
        $GLOBALS['queue']->next();
    }
}
