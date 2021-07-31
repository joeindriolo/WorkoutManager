<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);


$sql = new SQL();

$results = $sql->getWorkoutTypes();

if(mysqli_num_rows($results)>0) {
    echo "<SELECT name='exer' class='form-select' id='edd' onchange='changeToTextBox(this.value); enableAddButton();'>";
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


