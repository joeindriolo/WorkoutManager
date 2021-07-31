<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
$sql = new SQL();
$results = $sql->getAllWorkouts();

$wrk=null;
if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_array($results)) {
        $wrk= $row["queue"];
        $str= getString($wrk);
        echo "<script>
addEvent({'Date': new Date('".$row["date"]."'), 'Title':'".$row["duration"]."', 'Link': function(){document.getElementById('ext').innerHTML='$str';}});
</script>";
    }
}
echo '<script>
caleandar(document.getElementById("cal"),getEvents(),settings);
</script>';


function getString($queue) {
    $str=null;
    $data = unserialize($queue);
    $data->rewind();
    while($data->valid()) {
        $workoutobject = unserialize($data->current());
        if(!is_null($workoutobject)) $str.= $workoutobject->toString();
        $str .='<br>';
        $data->next();
    }
    return $str;
}