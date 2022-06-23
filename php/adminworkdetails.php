<?php

require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

function sql($s, $se, $hold, $lvl) {
    return "SELECT srg.matric_no FROM studentregcourses as srg JOIN tblstudents as st ON srg.matric_no = st.matric_no WHERE srg.$hold = '1' AND srg.semester = '{$s}' AND srg.session = '{$se}' AND st.levelId = $lvl";
}

// fetching data from the students table 
if (mysqli_num_rows($cQuery) > 0) {
    $sRows = mysqli_fetch_assoc($cQuery);
    $semes = $sRows['current_semester'];
    $sexion = $sRows['session'];

    function query($sql1, $sql2, $con) {
        $nosQuery = mysqli_query($con, $sql1) or die(mysqli_error($con));
        $totalNumsofStudent = mysqli_num_rows($nosQuery);
        
        $submittedQuery = mysqli_query($con, $sql2) or die(mysqli_error($con));
        $totalNumsofSubbmitted = mysqli_num_rows($submittedQuery);

        $totalNumsofUnsubbmitted =  $totalNumsofStudent - $totalNumsofSubbmitted;

        return $totalNumsofStudent . ' ' . $totalNumsofSubbmitted . ' ' . $totalNumsofUnsubbmitted;
    }

    // sql for nd1 
    $nosSql = sql($semes, $sexion, 'submit', '1'); 
    $submittedSql = sql($semes, $sexion, 'upload', '1');
    $output = query($nosSql, $submittedSql, $conn);

    // sql for hnd1 
    $nosSql = sql($semes, $sexion, 'submit', '3'); 
    $submittedSql = sql($semes, $sexion, 'upload', '3');
    $houtput = query($nosSql, $submittedSql, $conn);

    // sql for nd2 
    $nosSql = sql($semes, $sexion, 'submit', '2'); 
    $submittedSql = sql($semes, $sexion, 'upload', '2');
    $noutput = query($nosSql, $submittedSql, $conn);

    // sql for hnd2 
    $nosSql = sql($semes, $sexion, 'submit', '4'); 
    $submittedSql = sql($semes, $sexion, 'upload', '4');
    $hnoutput = query($nosSql, $submittedSql, $conn);


    echo $output . '-nd-' . $houtput. '-hnd-' . $noutput. '-nd2-' . $hnoutput . '-hnd2';
}






