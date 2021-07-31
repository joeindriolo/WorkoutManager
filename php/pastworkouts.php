<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

$sql = new SQL();

$results = $sql->getAllWorkouts();

$count=1;

echo '<div class="accordion" id="accordionExample">';

if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_array($results)) {
        ++$count;
        echo '
  <div class="accordion-item">
    <h2 class="accordion-header" id="heading'.$count.'">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$count.'" aria-expanded="false" aria-controls="collapse'.$count.'">'.
         $row["date"] . "  ". $row["duration"].
      '</button>
    </h2>
    <div id="collapse'.$count.'" class="accordion-collapse collapse" aria-labelledby="heading'.$count.'" data-bs-parent="#accordionExample">
      <div class="accordion-body">';
        $data = unserialize($row["queue"]);
        $data->rewind();
        while($data->valid()) {
            $workoutobject = unserialize($data->current());
            if(!is_null($workoutobject)) print_r($workoutobject->toString());
            echo '<br>';
            $data->next();
        }
        echo '
      </div>
    </div>
</div>';

    }
}
