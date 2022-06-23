<?php
session_start();
require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

if (mysqli_num_rows($cQuery) > 0) {
    $seRows = mysqli_fetch_assoc($cQuery);
    $semes = $seRows['current_semester'];
    $sexion = $seRows['session']; 

    $output = '';

    if ($semes == 'first') {
        $output =  'first semester is on';
    } else {
        if ($semes = 'second') {
            $output =  'second semester is on';
        }
    }

    echo $output;
}