<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
function my_autoloader($class) {
    include __DIR__ . '/' .$class .'.php';
}

spl_autoload_register('my_autoloader');



$sql = new SQL();

$type=null;

if(isset($_POST["type"])) {
    $type=$_POST["type"];
}
if(!is_null($type)) {
    $results=$sql->getWorkoutTypes();
    if(mysqli_num_rows($results)>0) {
        while($row=mysqli_fetch_array($results)) {
            $data[]= $row["Exercise"];
        }
        if(!in_array($type,$data)) {
            $sql->addWorkoutType($type);
        }else{
            echo 'Exercise already exists!';
        }
    }
}else{
    echo 'Error';
}
