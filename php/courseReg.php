<?php

// get the database conn 
require_once "../db/dbConnect.php";

$matNo = mysqli_real_escape_string($conn, $_POST['matNo']);

// get the seesion and semester from session tbl 
$seSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$seQuery = mysqli_query($conn, $seSql) or die(mysqli_error($conn));

if (isset($_POST['chkboxes'])) {
     if (!empty($matNo)) {
        $chkboxes = $_POST['chkboxes'];

        if (mysqli_num_rows($seQuery) > 0) {
            $seRows = mysqli_fetch_assoc($seQuery);
            $semester = $seRows['current_semester'];
            $session = $seRows['session'];
            $output = '';

            
            foreach ($chkboxes as $val) {
                // get the course id 
                $sql = "SELECT * FROM tblcourses WHERE course_code = '{$val}'";
                $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if (mysqli_num_rows($query) > 0) {
                    $rows = mysqli_fetch_assoc($query);
                    $lecturerId = $rows['lecturerId'];
                    $courseId = $rows['id']; 
                    
                    // check if the student already register for the course
                    $sql2 = "SELECT * FROM studentregcourses WHERE courseId = '{$courseId}' AND matric_no = '{$matNo}'";
                    $query2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
                    if (mysqli_num_rows($query2) > 0) {
                        // if the student has already register for the course do nothing 
                        $output = 'You have registered for the course';
                    } else {  
                        $inSql = "INSERT INTO `studentregcourses`(`matric_no`, `courseId`, `lecturerId`, `semester`, `session`, `submit`, `upload`, `edit`) VALUES ('{$matNo}', '{$courseId}', '{$lecturerId}', '{$semester}', '{$session}', '', '', '')";
                        $inQuery = mysqli_query($conn, $inSql) or die(mysqli_error($conn));

                        if (mysqli_affected_rows($conn) > 0) {
                            $gStuSql = "SELECT * FROM tblstudents WHERE matric_no = '{$matNo}'";
                            $gStuQuery = mysqli_query($conn, $gStuSql) or die(mysqli_error($conn));
                            if (mysqli_num_rows($gStuQuery) > 0) {
                                $nRows = mysqli_fetch_assoc($gStuQuery);
                                $stuLevel = $nRows['levelId'];
            
                                $cgSql = "SELECT * FROM `studentsgpacgpa` WHERE matric_no = '{$matNo}' AND levelId = '{$stuLevel}' AND `session` = '{$session}' AND `semester` = '{$semester}'";
                                $cgQuery = mysqli_query($conn, $cgSql) or die(mysqli_error($conn));
                                if (!mysqli_num_rows($cgQuery) > 0) {
                                    $cgpaSql = "INSERT INTO `studentsgpacgpa` (`matric_no`, `levelId`, `gpa`, `cgpa`, `courseUnit`, `creditPoints`, `semester`, `session`, `status`) VALUES ('{$matNo}','{$stuLevel}','0.00','0.00','0','0.00','{$semester}','{$session}','0')";
                                    $cgpaQuery = mysqli_query($conn, $cgpaSql) or die(mysqli_error($conn));
                                    if (mysqli_affected_rows($conn) > 0) {
                                        $output = 'Course Successfuly registered';
                                    }
                                } else {
                                    $output = 'Course is registered successfully';
                                }
                            }
                        }
                    } 
                }
            } 
            echo $output;
        }
    }
} else {
    echo 'An error occured thats all we know';
}

