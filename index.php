<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
session_start();

include 'php/autoloader.php';
$sql = new SQL();
$sql->checkAndCreateTables();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/theme3.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/ab48f33bcd.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/time.js"></script>
    <script type="text/javascript" src="js/calutils.js"></script>
    <script type="text/javascript" src="js/caleandar.min.js"></script>
    <title>Workout Manager</title>
</head>
<body>
<div class="container-fluid main-content">
    <div class="homeBar">
        <nav class="nav menu justify-content-center">
            <a class="nav-link" href="#" id="home">Home</a>
            <a class="nav-link " href="#" id="past">History</a>
            <a class="nav-link" href="#" id="type">Workouts</a>
            <a class="nav-link" href="#" id="calendar">Calendar</a>
        </nav>
    </div>
    <div class="home-content" id="welcome">
        <h1 class="greetingText" id="greeting"></h1>
        <script>printGreeting()</script>
        <div class="lastWorkoutData">
            <h2>Your last workout:</h2>
            <?php include 'php/lastworkoutsql.php'; ?>
        </div>

        <div class="startButton">
            <button type="button" class="btn btn-success" id="toggle" onclick="startTimer()"><i class="far fa-file"></i> Start New Workout</button>
        </div>
    </div>

    <div class="start-workout" id="start-workout">
        <h1 class="workoutText"> <i class="fas fa-dumbbell"></i> Today's Workout</h1>
        <h2 id="date"></h2>
        <script>getDate()</script>
        <h3 id="timer">00:00:00</h3>
        <form id="form" method="post">
            <div class="row justify-content-center" id="formrow">
                <div class="col-auto">
                    <div id="exerciseDropdown" class="exd">
                        <?php require 'php/workoutdropdown.php'; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <input type="number" class="form-control" id="number" name="number" placeholder="#" autocomplete="off">
                </div>
                <div class="col-sm-1">
                    <select name="type" class="form-select" id="typedropdown" onchange="{addRepSelector(this.value); enableAddButton();}">
                        <option value ="default">Select Type</option>
                        <option value="Minutes">Minutes</option>
                        <option value="Seconds">Seconds</option>
                        <option value="Reps">Reps</option>
                        <option value="Sets">Sets</option>
                    </select>
                </div>
                    <div class="col-auto" id="ofText">
                        <h4 id="oftext">Of</h4>
                    </div>
                    <div class="col-auto" id="setAmount">
                        <input type="number" class="form-control" name="reps" id="reps" placeholder="#" autocomplete="off">
                    </div>
                <div class="col-sm-1">
                    <input type="number" class="form-control" id="lbs" name="lbs" placeholder="lbs" autocomplete="off">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <button type="button" name="add" class="btn btn-success" onclick="addWorkout()" id="addButton" disabled><i class="fas fa-plus"></i> Add Workout</button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger" onclick="endWorkout()" id="endButton"><i class="fas fa-stop"></i> End Workout</button>
                </div>
            </div>
            <div class="currentWorkout" id="currentWorkout" name="currentWorkout">
                <h4 id="current">Current Workout:</h4>
                <?php include 'php/displayqueue.php';?>
            </div>
        </form>
    </div>
    <div class="endWorkout" id="endWorkout">
        <h2 class="summaryText">Workout Summary</h2>
    </div>
    <div class="history" id="history">
        <h2 class="text-center" style="padding-top: 60px">Past workouts</h2>
        <?php include 'php/pastworkouts.php';?>
    </div>
</div>

    <div class="typeList" id="typeList">
        <h2 class="text-center" style="padding-top: 60px">Workout List</h2>
        <div class="input-group mb-3 justify-content-center">
            <div class="col-auto">
                <input type="text" id="addType" class="form-control" placeholder="Add Workout">
            </div>
            <div class="col-auto">
                <button type="button" onclick="addWorkoutType()" class="btn btn-success">Add Workout</button>
            </div>
        </div>
        <?php include 'php/workouttypes.php';?>
    </div>

<div class="cal" id="cal">
    <?php include 'php/calendar.php';?>
</div>
<div class="calDetails" id="calDetails">
    <h3>Workout Details</h3>
    <p id="ext">Click a workout to see more info</p>
</div>



</div>
</body>
</html>