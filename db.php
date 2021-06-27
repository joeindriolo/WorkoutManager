<?php

function openConnection() {
    $host = "localhost";
    $username= "root";
    $password = "root";
    $db= "data";
    $connection = new mysqli($host,$username,$password,$db) or die("Connection failed: %s\n". $connection -> error);
    return $connection;
}

function closeConnection($connection) {
    $connection -> close();
}

function checkAndCreateTables() {
    $sql = "CREATE TABLE Workouts (
   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(255) NOT NULL,
   name2 VARCHAR(255) NOT NULL
)";
    $table2 = "CREATE TABLE ExerciseList(
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    Exercise VARCHAR(255) NOT NULL
)";
    $conn = openConnection();

    if(!mysqli_query($conn,"DESCRIBE workouts")) {
        echo "Creating Tables...";
        mysqli_query($conn,$sql);
        mysqli_query($conn,$table2);
    }else{
        echo "Tables already exist";
    }
}
?>