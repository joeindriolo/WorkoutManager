<?php

$sql = new SQL();
$results = $sql->getAllWorkouts();

$wrk=null;
if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_array($results)) {
        echo "<script>
addEvent({'Date': new Date('".$row["date"]."'), 'Title':'".$row["duration"]."', 'Link': function(){document.getElementById('ext').append('')}});
</script>";
    }
}
echo '<script>
caleandar(document.getElementById("cal"),getEvents(),settings);
</script>';

//calendar works, need to just display the actual workout data when click the duration from calendar


function printQueue($queue) {
    $data = unserialize($queue);
    $data->rewind();
    while($data->valid()) {
        $workoutobject = unserialize($data->current());
        if(!is_null($workoutobject)) print_r($workoutobject->toString());
        $data->next();
    }
}