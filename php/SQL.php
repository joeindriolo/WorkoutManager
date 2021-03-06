<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

class SQL
{
    function openConnection() {
        $host = "localhost";
        $username = "root";
        $password = "root";
        $db = "data";
        $connection = new mysqli($host, $username, $password, $db) or die("Connection failed: %s\n" . $connection->error);
        return $connection;
    }

    function closeConnection($connection) {
        $connection->close();
    }

    function checkAndCreateTables()
    {
        $sql = "CREATE TABLE Workouts (
   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   date VARCHAR(255) NOT NULL,
   duration VARCHAR(255) NOT NULL,
   queue VARCHAR(255) NOT NULL
)";
        $table2 = "CREATE TABLE ExerciseList(
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    Exercise VARCHAR(255) NOT NULL
)";
        $conn = $this->openConnection();

        if (!mysqli_query($conn, "DESCRIBE workouts")) {
            echo "Creating Tables...";
            mysqli_query($conn, $sql);
            mysqli_query($conn, $table2);
        }
    }

    function addWorkout($date, $duration, $queue) {
        $conn = $this->openConnection();
        $sql = "INSERT INTO workouts (date, duration, queue) VALUES ('$date', '$duration', '$queue')";
        if (mysqli_query($conn, $sql)) {
            //
        } else {
            echo $conn->error;
        }
    }

    function addWorkoutType($type) {
        $conn = $this->openConnection();
        $sql = "INSERT INTO exerciselist (exercise) VALUES ('$type')";
        if (mysqli_query($conn, $sql)) {
            echo 'Successful';
        } else {
            echo $conn->error;
        }
    }

    function getWorkoutTypes() {
        $conn = $this->openConnection();
        $sql = "SELECT Exercise FROM ExerciseList ORDER BY Exercise ASC";
        $results=mysqli_query($conn,$sql);
        return $results;
    }

    function getAllWorkouts() {
        $conn = $this->openConnection();
        $sql = "SELECT * FROM workouts";
        $results=mysqli_query($conn, $sql);
        return $results;
    }

    function getLastWorkout() {
        $conn= $this->openConnection();
        $sql= "SELECT * FROM workouts ORDER BY ID DESC LIMIT 1";
        $results=mysqli_query($conn,$sql);
        return $results;
    }
}