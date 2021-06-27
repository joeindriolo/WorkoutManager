<?php
require 'db.php';
require 'WorkoutQueue.php';
$queue = new SplQueue();
new WorkoutQueue();
$conn= openConnection();
$sql = "SELECT Exercise FROM ExerciseList";
$results = mysqli_query($conn,$sql);


if(mysqli_num_rows($results)>0) {
    echo "<SELECT name='exer' class='form-control' id='edd' onchange='changeToTextBox(this.value); enableAddButton();'>";
    echo "<option value='default'>Select Exercise</option>";
    while($row=mysqli_fetch_array($results)) {
        $exercise = $row['Exercise'];
        echo "<option value = '$exercise'>$exercise</option>";
    }
    echo "<option value = 'new'>Add new</option>";
    echo "</select>";
}else{
    $conn->error;
}
?>

