<?php

// get the database conn 
require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

$stuMat = mysqli_real_escape_string($conn, $_POST['stuMat']);
$sexion = mysqli_real_escape_string($conn, $_POST['sexion']);

// check if the value is not empty  
if (!empty($stuMat)) { 
    if (mysqli_num_rows($cQuery) > 0) {
        $seRows = mysqli_fetch_assoc($cQuery);
        $semes = $seRows['current_semester']; 

        // fetching the student result from db 
        $sql = "SELECT sc.id, sc.course_title, sc.course_code, tr.matric_no, sc.course_unit, sc.course_type, tr.creditPoint, tr.grade FROM tblresult as tr JOIN tblcourses as sc ON sc.id = tr.courseId WHERE tr.matric_no = '{$stuMat}' AND tr.session= '{$sexion}' AND tr.semester= '{$semes}' AND tr.upload = 1 AND edit = 0";

        // query the database 
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
                        <td>'. $rows['matric_no'] .'</td>
                        <td>'. $rows['course_title'] .'</td>
                        <td>'. $rows['course_code'] .'</td>
                        <td>'. $rows['course_unit'] .'</td>
                        <td>'. $rows['course_type'] .'</td>
                        <td>'. $rows['creditPoint'] .'</td>
                        <td>'. $rows['grade'] .'</td>
                        <td><button id="'. $rows['id'] . '-' . $rows['matric_no'] .'" onClick="aEdit(this)">Allow Edit</button></td>
                    </tr>
                ';
            }
        }
        echo $output;
    }
}