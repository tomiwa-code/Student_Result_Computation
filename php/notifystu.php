<?php
session_start();
// get the database conn 
require_once "../db/dbConnect.php";

// fetch the last notification of this curent student 
$sql = "SELECT te.text FROM `tblnotify` as tny JOIN `tblevents` as te ON te.id = tny.eventId WHERE `matric_no`= '{$_SESSION['unique_id']}' AND `status`= '0' ORDER BY tny.date DESC LIMIT 1";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if (mysqli_num_rows($query) > 0) {
    $rows = mysqli_fetch_assoc($query);

    echo $rows['text'];
}
