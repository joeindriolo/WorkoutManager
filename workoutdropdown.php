<?php
require 'db.php';

//try to use cookies
//is set if not new one, if is read it

$conn= openConnection();
$sql = "SELECT Exercise FROM ExerciseList";
$results = mysqli_query($conn,$sql);

//i think there is an issue with the order the classes load in , i can set static queue in addworkout.php, but not this one

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

