<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $var = $_POST['type'];
    echo $var;
    echo 'lol';


    if(isset($_POST['type'])){
        echo 'jk';
        if($_POST['type']=='Sets') {
            echo "<script> addRepSelector($('#hide')); 
    addRepSelector($('#hide2')); 
    console.log('Test');</script>";
        }
    }
}
?>