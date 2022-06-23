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

    // function for lecturer work details
    function lewDetails($uniqueId, $con, $s, $se, $lvl, $lvlId) {
        $newSql = "SELECT srg.courseId FROM studentregcourses as srg JOIN tblcourses as sc ON srg.courseId = sc.id WHERE srg.lecturerId = '{$uniqueId}' AND srg.semester = '{$s}' AND srg.session = '{$se}' AND sc.levelId = '$lvl'";

        $newQuery = mysqli_query($con, $newSql) or die(mysqli_error($con)); 

        if (mysqli_num_rows($newQuery) > 0) {
            $getCidRows = mysqli_fetch_assoc($newQuery);
            $lecID = $getCidRows['courseId'];

            // fetching data from the students table 
            $sql = "SELECT * FROM studentregcourses WHERE courseId = '{$lecID}' AND `semester`='{$s}' AND `session`='{$se}'";
            $query = mysqli_query($con, $sql) or die(mysqli_error($con));

            // total number of students 
            $totalNumOfStudents = mysqli_num_rows($query);

            // total number of student score submitted 
            $submittedSql = "SELECT * FROM studentregcourses WHERE courseId = '{$lecID}' AND submit = '1'";
            $submittedQuery = mysqli_query($con, $submittedSql)or die(mysqli_error($con));
            $totalNumOfSubmitted = mysqli_num_rows($submittedQuery);
            
            // total number of student score yet to be submitted 
            $totalNumOfUnSubmitted = $totalNumOfStudents - $totalNumOfSubmitted;
    
            // all output goes here 
            return $totalNumOfStudents . "," . $totalNumOfSubmitted . "," . $totalNumOfUnSubmitted . "," . $lvlId;
        }
    }

    // for ND1 
    $nd1 = lewDetails($_SESSION['unique_id'], $conn, $semes, $sexion, 1, 'nd');

    // for ND2 
    $nd2 = lewDetails($_SESSION['unique_id'], $conn, $semes, $sexion, 2, 'nd2');

    // for HND1 
    $hnd1 = lewDetails($_SESSION['unique_id'], $conn, $semes, $sexion, 3, 'hnd');

    // for HND2 
    $hnd2 = lewDetails($_SESSION['unique_id'], $conn, $semes, $sexion, 4, 'hnd2');

    echo $nd1 . '_' . $nd2 . '_' . $hnd1 . '_' . $hnd2;
}





