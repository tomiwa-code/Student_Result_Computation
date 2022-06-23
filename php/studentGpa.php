<?php
// start the session to know the current user 
session_start();

// get the database conn 
require_once "../db/dbConnect.php";

function sql($user, $s, $lvl, $con) {
    $sql = "SELECT * FROM `studentsgpacgpa` WHERE matric_no = '{$user}' AND `semester` = '{$s}' AND `levelId` = $lvl";
    $query = mysqli_query($con, $sql) or die(mysqli_error($con)); 

    // if query was a success 
    if (mysqli_num_rows($query) > 0) {
        $rows = mysqli_fetch_assoc($query);
        echo $rows['gpa'] . '-' . $rows['cgpa'] . '-' . $rows['courseUnit'];
    }
}

$semes = mysqli_real_escape_string($conn, $_POST['semes']);
$stulvl = mysqli_real_escape_string($conn, $_POST['stulvl']);

// fetching the student result from db 
$output = sql($_SESSION['unique_id'], $semes, $stulvl, $conn); 

echo $output;


