<?php

session_start();
require_once "../db/dbConnect.php";

$matric_no = mysqli_real_escape_string($conn, $_POST['matric_no']);
$stuScore = mysqli_real_escape_string($conn, $_POST['stuScore']);
$courseId = mysqli_real_escape_string($conn, $_POST['courseId']);

// get the current session and semester of the school 
$chsSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$chsQuery = mysqli_query($conn, $chsSql) or die(mysqli_error($conn));

if (mysqli_num_rows($chsQuery) > 0) {
    $seRows = mysqli_fetch_assoc($chsQuery);
    $semes = $seRows['current_semester'];
    $sexion = $seRows['session']; 

    // get the lecturerid from tblcourse 
    $getCidSql = "SELECT * FROM  studentregcourses WHERE lecturerId = '{$_SESSION['unique_id']}'";
    $getCidQuery = mysqli_query($conn,$getCidSql) or die(mysqli_error($conn));

    if (mysqli_num_rows($getCidQuery) > 0) {
        // get the current student column
        $sqlMatric = "SELECT * FROM tblstudents WHERE matric_no = '{$matric_no}'";
        $queryMatric = mysqli_query($conn, $sqlMatric) or die(mysqli_error($conn));

        if ($stuScore == '') {
            echo 'Score cannot be empty';
        }  else {
            if (!is_numeric($stuScore)) {
                echo 'Score can only be number';
            } else {
                if ($stuScore > 100) {
                    echo 'Score cannot be greater than 100';
                } else {
                    // function for student sql 
                    function sql($matricNo, $lvl) {
                        return "SELECT * FROM tblstudents WHERE matric_no = '{$matricNo}' AND `levelId` = $lvl";
                    }

                    // function to score student 
                    function scoreStu($q, $con, $ci, $s, $se, $stu) {
                        if (mysqli_num_rows($q) > 0) {
                            $getStuRows = mysqli_fetch_assoc($q);
                            $matNo = $getStuRows['matric_no'];
                            $levelId = $getStuRows['levelId'];

                            // check if student already in result table 
                            $cSql = "SELECT * FROM tblresult WHERE matric_no = '{$matNo}' AND courseId = '{$ci}' AND `semester`= '{$s}' AND `session`= '{$se}'";
                            $cQuery = mysqli_query($con, $cSql) or die(mysqli_error($con));         
                            
                            if (mysqli_num_rows($cQuery) > 0) {
                                // update the result table 
                                $upSql = "UPDATE `tblresult` SET `marks`='{$stu}',`grade`='F',`creditPoint`='0.00',`semester`='{$s}',`session`='{$se}',`submit`= '1', `upload`= '0', `edit`= '0' WHERE matric_no = '{$matNo}' AND courseId = '{$ci}'";
                                $upQuery = mysqli_query($con, $upSql) or die(mysqli_error($con));

                                if ($upQuery) {
                                    // sql to update submit in studentregcourse table
                                    $sqlII = "UPDATE `studentregcourses` SET `submit`= '1' WHERE `matric_no` = '{$matNo}' AND `courseId` = '{$ci}'";
                                    $queryII = mysqli_query($con, $sqlII) or die(mysqli_error($con));

                                    if ($queryII) {
                                       return 'Successfully Updated';
                                    }
                                }
                            } else {
                                // sql to insert into result table 
                                $sql = "INSERT INTO `tblresult`(`matric_no`, `levelId`, `courseId`, `marks`, `grade`, `creditPoint`, `semester`, `session`,`submit`, `upload`, `edit`) VALUES ('{$matNo}', '{$levelId}', '{$ci}', '{$stu}', 'F', '0.00', '{$s}', '{$se}', '1', '0', '0')";
                                $query = mysqli_query($con, $sql) or die(mysqli_error($con));

                                if ($query) {
                                    // sql to update submit in studentregcourse table
                                    $sqlII = "UPDATE `studentregcourses` SET `submit`= '1' WHERE `matric_no` = '{$matNo}' AND `courseId` = '{$ci}'";
                                    $queryII = mysqli_query($con, $sqlII) or die(mysqli_error($con)); 

                                    if ($queryII) {
                                       return "Successfully Inserted";
                                    }
                                }
                            }
                        }
                    }

                    //  if the matric number is found in tblStudents 
                    if (mysqli_num_rows($queryMatric) > 0) {
                        // get the student details from student for ND1
                        $getStuSql = sql($matric_no, '1');

                        // get the student details from student for HND1
                        $hgetStuSql = sql($matric_no, '3');

                        // get the student details from student for ND2
                        $ngetStuSql = sql($matric_no, '2');

                        // get the student details from student for HND1
                        $hngetStuSql = sql($matric_no, '4');
                        
                        // for ND1 
                        $getStuQuery = mysqli_query($conn, $getStuSql) or die(mysqli_error($conn));
                        echo scoreStu($getStuQuery, $conn, $courseId, $semes, $sexion, $stuScore);

                        // for HND1
                        $hgetStuQuery = mysqli_query($conn, $hgetStuSql) or die(mysqli_error($conn));
                        echo scoreStu($hgetStuQuery, $conn, $courseId, $semes, $sexion, $stuScore);

                        // for ND2 
                        $ngetStuQuery = mysqli_query($conn, $ngetStuSql) or die(mysqli_error($conn));
                        echo scoreStu($ngetStuQuery, $conn, $courseId, $semes, $sexion, $stuScore);

                        // for HND2
                        $hngetStuQuery = mysqli_query($conn, $hngetStuSql) or die(mysqli_error($conn));
                        echo scoreStu($hngetStuQuery, $conn, $courseId, $semes, $sexion, $stuScore);
                    }
                }
            }
        }
    }
}


