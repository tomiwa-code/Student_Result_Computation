<?php

require_once "../db/dbConnect.php";

$stuMatric = mysqli_real_escape_string($conn, $_POST['params']);

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

if (mysqli_num_rows($cQuery) > 0) {
    $seRows = mysqli_fetch_assoc($cQuery);
    $sexion = $seRows['session']; 

    // get the current sturdent 
    $scoreSql = "SELECT * FROM tblstudents WHERE matric_no = '{$stuMatric}'";
    $scoreQuery = mysqli_query($conn, $scoreSql);

    if (mysqli_num_rows($scoreQuery) > 0) {
        $scoreRows = mysqli_fetch_assoc($scoreQuery);
        echo $scoreRows["lastname"]. " " . $scoreRows["firstname"] . " " . $scoreRows["middlename"]. "-" . $scoreRows['matric_no']; 
    }

}




