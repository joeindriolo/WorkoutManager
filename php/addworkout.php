<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

function my_autoloader($class) {
    include __DIR__ . '/' .$class .'.php';
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

$sql = new SQL();
$exercise=null;
$number=null;
$type=null;
$repAmount=null;
$lbs=null;
$data=null;

if(isset($_POST["exer"])) {
    $exercise = $_POST["exer"];
    $number = $_POST["number"];
    $type = $_POST["type"];
    if($type=="Sets") {
        $repAmount= $_POST['reps'];
    }
    if($_POST["lbs"]=="") {
        $lbs=null;
    }else{
        $lbs=$_POST["lbs"];
    }


    if(is_null($repAmount) && is_null($lbs)) {
        $queue->push(serialize(new WorkoutObject($exercise,$number,$type)));
    }
    else if(is_null($repAmount) && !is_null($lbs)) {
        $queue->push(serialize(new WorkoutObject($exercise,$number,$type,$lbs)));
    }
    else if(!is_null($repAmount) && !is_null($lbs)) {
        $queue->push(serialize(new WorkoutObject($exercise,$number,$type,$repAmount,$lbs)));
    }

    $results=$sql->getWorkoutTypes();
    if(mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
            $data[]= $row["Exercise"];
        }
        if(!in_array($exercise,$data)) {
            $sql->addWorkoutType($exercise);
        }
    }

    $queue->rewind();
    while($queue->valid()) {
        $workoutobject = unserialize($queue->current());
        print_r( $workoutobject->toString());
        echo "<br>";
        $queue->next();
    }
}


