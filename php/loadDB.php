<?php
session_start();

// get the php database file
include_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

function sql($lec, $s, $se, $lvl, $conn, $lvlId) {
    $sql = "SELECT * FROM tblcourses WHERE lecturerId = '{$lec}' AND semester = '{$s}' AND `session`= '{$se}' AND levelId = $lvl";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($query) > 0) {
        $rows = mysqli_fetch_assoc($query);
        return $rows['course_code'] .','. $rows['course_unit'] .','. $rows['course_title'] .','. $rows['semester'] .','. $rows['session'] .','. $lvlId;
    }
}

if (mysqli_num_rows($cQuery) > 0) {
    $seRows = mysqli_fetch_assoc($cQuery);
    $semes = $seRows['current_semester'];
    $sexion = $seRows['session'];

    $lecturerId = $_SESSION['unique_id'];

    // for ND1
    $nd1 = sql($lecturerId, $semes, $sexion, '1', $conn, 'nd');

    // for ND2
    $nd2 = sql($lecturerId, $semes, $sexion, '2', $conn, 'nd2');

    // for HND1
    $hnd1 = sql($lecturerId, $semes, $sexion, '3', $conn, 'hnd');

    // for HND2
    $hnd2 = sql($lecturerId, $semes, $sexion, '4', $conn, 'hnd2');

    echo $nd1 . '_' . $nd2 . '_' . $hnd1 . '_' . $hnd2;
}