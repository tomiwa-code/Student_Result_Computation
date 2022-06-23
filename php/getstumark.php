<?php

require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

function sql($matNo, $sid, $s, $se) {
    return "SELECT tc.course_unit, tr.marks FROM tblcourses as tc JOIN tblresult as tr ON tc.id = tr.courseId WHERE tr.matric_no = '{$matNo}' AND courseId = '{$sid}' AND tr.semester = '{$s}' AND tr.session = '{$se}'";
}

function studentScore($q) {
    // if the query is correct get data 
    if (mysqli_num_rows($q) > 0) {
        $rows = mysqli_fetch_assoc($q);
        return $rows['marks'] .' '. $rows['course_unit'];
    }
}

// get the data sent from the javascript 
$stuMatric = mysqli_real_escape_string($conn, $_POST['matNo']);
$stuCourse = mysqli_real_escape_string($conn, $_POST['stuCourse']);

// if the datas are not empty 
if (!empty($stuMatric) && !empty($stuCourse)) {

    if (mysqli_num_rows($cQuery) > 0) {
        $sRows = mysqli_fetch_assoc($cQuery);
        $semes = $sRows['current_semester'];
        $sexion = $sRows['session'];

        // get the mark and course unit of this particular student in nd1
        $sql = sql($stuMatric, $stuCourse, $semes, $sexion);
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $output = studentScore($query);

        echo $output;
    }
} else {
    echo "An error occured, That's all we know";
}