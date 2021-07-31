<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
$sql = new SQL();
$results= $sql->getWorkoutTypes();
echo '<ul class="list-group">';
if(mysqli_num_rows($results)>0) {
    while($data=mysqli_fetch_array($results)) {
        echo '<li class="list-group-item">'.$data["Exercise"].'</li>';
    }
}
echo '</ul>';
