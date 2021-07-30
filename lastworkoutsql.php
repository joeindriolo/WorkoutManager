<?php

$sql= new SQL();

$results = $sql->getLastWorkout();

echo '<div class="lastworkoutSQL">';

if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_array($results)) {
        $data = unserialize($row["queue"]);
        $data->rewind();
        while($data->valid()) {
            $workoutobject = unserialize($data->current());
            if(!is_null($workoutobject)) print_r($workoutobject->toString());
            echo '<br>';
            $data->next();
        }
    }
}
echo '</div>';
