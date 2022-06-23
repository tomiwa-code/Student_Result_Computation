<?php
// start the session to know the current user 
session_start();

// get the database conn 
require_once "../db/dbConnect.php";

$semes = mysqli_real_escape_string($conn, $_POST['semes']);
$stulvl = mysqli_real_escape_string($conn, $_POST['stulvl']);

// fetching the student result from db 
$sql = "SELECT sc.course_title, sc.course_code, sc.course_unit, sc.course_type, tr.creditPoint, tr.grade FROM tblresult as tr JOIN tblcourses as sc ON sc.id = tr.courseId WHERE matric_no = '{$_SESSION['unique_id']}' AND tr.upload = 1 AND tr.semester = '{$semes}' AND tr.levelId = '{$stulvl}' AND  grade = 'f'";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

// declare variable to hold the table 
$output = '';

// if query was a success 
if (mysqli_num_rows($query) > 0) {
    // starting point for id 
    $id = '0';
    // get all this student marks 
    while ($rows = mysqli_fetch_assoc($query)) {
        $id ++;
        $output .= '
            <tr>
                <td>'. $id .'</td>
                <td>'. $rows['course_title'] .'</td>
                <td>'. $rows['course_code'] .'</td>
                <td>'. $rows['course_unit'] .'</td>
                <td>'. $rows['course_type'] .'</td>
                <td>'. $rows['creditPoint'] .'</td>
                <td>'. $rows['grade'] .'</td>
            </tr>
        ';
    }
}

echo $output . '-'. 'failed';
