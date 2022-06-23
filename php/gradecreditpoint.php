<?php

require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

$stuMatric = mysqli_real_escape_string($conn, $_POST['matric_no']);
$course_Id = mysqli_real_escape_string($conn, $_POST['course_Id']);
$stuGrade = mysqli_real_escape_string($conn, $_POST['stuGrade']);
$stuCreditPoint = mysqli_real_escape_string($conn, $_POST['stuCreditPoint']);

// if the datas from js are not empty 
if (!empty($stuMatric) && !empty($course_Id) && !empty($stuGrade) && $stuCreditPoint >= 0) {

    if (mysqli_num_rows($cQuery) > 0) {
        $sRows = mysqli_fetch_assoc($cQuery);
        $semes = $sRows['current_semester'];
        $sexion = $sRows['session'];

        $sql = "UPDATE `tblresult` SET `grade`= '{$stuGrade}',`creditPoint`= '{$stuCreditPoint}',`upload`= '1' WHERE `matric_no`= '{$stuMatric}' AND `courseId`= '{$course_Id}' AND semester = '{$semes}' AND `session` = '{$sexion}'";

        // check if the sql is correct 
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($query) {
            // if the query was successful update the studentregcourse table 
            $sqlRegCourse = "UPDATE `studentregcourses` SET `upload`= '1' WHERE `matric_no`= '{$stuMatric}' AND `courseId`= '{$course_Id}' AND semester = '{$semes}' AND `session` = '{$sexion}'";
            $queryRegCourse =  mysqli_query($conn, $sqlRegCourse) or die(mysqli_error($conn));

            if ($queryRegCourse) {
                // get the course code of this current course
                $getCourseTSql = "SELECT course_code FROM tblcourses WHERE id = '{$course_Id}' AND semester = '{$semes}' AND `session` = '{$sexion}'";
                $getCourseQuery = mysqli_query($conn, $getCourseTSql) or die(mysqli_error($conn));
                // if the query is a success 
                if (mysqli_num_rows($getCourseQuery) > 0) {
                    // fetch the column from the db 
                    $getCourseRows = mysqli_fetch_assoc($getCourseQuery);
                    echo $stuMatric . ' ' . $getCourseRows['course_code'] . "-Result uploaded succesfully!";
                }
            }
        }
    }
}