<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="time.js"></script>
    <title>Workout Manager</title>
</head>
<body>
<div class="container-fluid main-content">
    <div class="homeBar">
        <nav class="nav menu justify-content-center">
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link" href="#">Today</a>
            <a class="nav-link" href="#">Workouts</a>
            <a class="nav-link" href="#">Calendar</a>
        </nav>
    </div>
    <div class="home-content" id="welcome">
        <h1 class="greetingText" id="greeting"></h1>
        <script>printGreeting()</script>
        <div class="lastWorkoutData">
            <h3>Your last workout:</h3>
            <p>30 Squats <br> 30 Pushups <br> 3 sets of 10 200lb curls</p>
        </div>

        <div class="startButton">
            <button type="button" class="btn btn-success" id="toggle" onclick="startTimer()">Start New Workout</button>
        </div>
    </div>

    <div class="start-workout" id="start-workout">
        <h1 class="workoutText">Today's Workout</h1>
        <h2 id="date"></h2>
        <script>getDate()</script>
        <h3 id="timer">00:00:00</h3>
        <form id="form" method="post" action="addworkout.php" return false;>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-2">
                    <div class="form-group" id="exerciseDropdown">
                        <?php require 'workoutdropdown.php'; ?>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <input type="number" class="form-control" id="number" name="number" placeholder="#" autocomplete="off">
                    </div>
                </div>
                <div class="col-sm-2">
                    <select name="type" class="form-control" id="typedropdown" onchange="{addRepSelector(this.value); enableAddButton();}">
                        <option value ="default">Select Type</option>
                        <option value="Minutes">Minutes</option>
                        <option value="Seconds">Seconds</option>
                        <option value="Reps">Reps</option>
                        <option value="Sets">Sets</option>
                    </select>
                </div>
                    <div class="col-sm-1" id="hide">
                        <h4 id="oftext">Of</h4>
                    </div>
                    <div class="col-sm-1" id="hide2">
                        <input type="number" class="form-control" name="reps" id="reps" placeholder="#" autocomplete="off">
                    </div>
                    <div class="col-sm-1">
                    <input type="number" class="form-control" id="lbs" name="lbs" placeholder="lbs" autocomplete="off">
                </div>
            </div>
        </div>
            <div class ="row justify-content-center">
                <div class="col-sm-1">
                    <button type="submit"  form="form" name="add" class="btn btn-success" id="addButton" disabled>Add Workout</button>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-danger" onclick="stopTimer()">End Workout</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>