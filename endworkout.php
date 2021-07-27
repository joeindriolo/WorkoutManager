<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function my_autoloader($class) {
    include __DIR__ .'/'.$class .'.php';
}

spl_autoload_register('my_autoloader');

session_start();

//date, time, duration, queue
$date=null;
$duration=null;
$queue=$_SESSION["queue"];

$sql = new SQL();

if(is_null($queue)) {
    echo 'Cannot add workout, the queue is empty.';
}else{
    echo "<div class='summary'>";
    if(isset($_POST["date"])) {
        $date=$_POST["date"];
        echo "<h3>$date</h3>";
    }
    if(isset($_POST["timer"]))  {
        $duration=$_POST["timer"];
        echo "<h3>$duration</h3>";
    }

    echo "<?php include 'displayqueue.php'?>";
    $so = serialize($_SESSION["queue"]);
    $sql->addWorkout($date,$duration, $so);
    echo "</div>";
}







