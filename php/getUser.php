<?php

session_start();
require_once "../db/dbConnect.php";

$sql = "SELECT * FROM tblstudents WHERE matric_no = '{$_SESSION['unique_id']}'";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if (mysqli_num_rows($query) > 0) {
    $rows = mysqli_fetch_assoc($query);
    $stuLevel = $rows["levelId"];
    
    $output = '';
    if ($stuLevel == 1 || $stuLevel == 2) {
        $output = "Na Nd student";
    } else {
        if ($stuLevel == 3 || $stuLevel == 4) {
            // check if it is an old student 
            $oStu = explode('/', $rows['matric_no']);
            if ($oStu[1] == 69 || $oStu[1] == 71 || $oStu[1] == 85) {
                $output = "na Old Student";
            } else {
                // if student is a foreign key 
                $output = "na Foriegn Key";
            }
        }
    }
    echo $output;
}