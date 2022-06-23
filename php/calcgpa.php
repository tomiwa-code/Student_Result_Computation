<?php

// get the database conn 
require_once "../db/dbConnect.php";

$matric_no = mysqli_real_escape_string($conn, $_POST['matric_no']);
$courseId = mysqli_real_escape_string($conn, $_POST['courseId']);

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

// if the datas from js are not empty 
if (!empty($matric_no) && !empty($courseId)) {

    if (mysqli_num_rows($cQuery) > 0) {
        $sRows = mysqli_fetch_assoc($cQuery);
        $semes = $sRows['current_semester'];
        $sexion = $sRows['session'];

        // fetching the student result from db 
        $sql = "SELECT sc.course_unit, tr.creditPoint, tr.levelId FROM tblresult as tr JOIN tblcourses as sc ON sc.id = tr.courseId WHERE matric_no = '{$matric_no}' AND tr.upload = 1 AND tr.semester = '{$semes}' AND tr.session = '{$sexion}'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // if query was a success 
        if (mysqli_num_rows($query) > 0) {
            // get student level from student table 
            $stuSql = "SELECT * FROM tblstudents WHERE matric_no = '{$matric_no}'";
            $stuQuery = mysqli_query($conn, $stuSql) or die(mysqli_error($conn));
            $nrows = mysqli_fetch_assoc($stuQuery);
            $stuLevel = $nrows['levelId'];

            // calculate gpa 
            setGp($matric_no, $stuLevel, $sexion, $query, $conn, $courseId, $semes);
            setCgpa($matric_no, $sexion, $query, $conn, $stuLevel);
            setCgpa2($matric_no, $sexion, $query, $conn, $stuLevel);
            finalCgpa($matric_no, $sexion, $query, $conn, $stuLevel);
        }
    } 
}

// function to calculate gp 
function setGp($matNo, $lvl, $se, $q, $con, $cid, $s) {
    // check if the student has data in table studentgpacgpa
    $gpSql = "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= '{$s}' AND `session`= '{$se}' AND `levelId`= $lvl";
    $gpQuery = mysqli_query($con, $gpSql) or die(mysqli_error($con));
    if (mysqli_num_rows($gpQuery) > 0) {

        // declare variable for course unit and credit point
        $totalCourseUnit = 0;
        $totalCreditPoint =  0.00;
        while ($rows= mysqli_fetch_assoc($q)) {
            $totalCourseUnit += $rows['course_unit']; 
            $totalCreditPoint += $rows['creditPoint'];
        }

        // avoid division by zero 
        if ($totalCourseUnit != 0) {
            // gpa and cgpa of this current student 
            $gpaF = $totalCreditPoint / $totalCourseUnit;
            $gpa = floor($gpaF*100)/100;
            // update the student gpa and cgpa table in db 
            $cSql = "UPDATE `studentsgpacgpa` SET `gpa`= '{$gpa}', `cgpa`= '{$gpa}', `courseUnit` = '{$totalCourseUnit}', `creditPoints`= '{$totalCreditPoint}', `status`= '1' WHERE matric_no = '{$matNo}' AND `session`= '{$se}' AND `semester`= '{$s}'";
            $cQuery = mysqli_query($con, $cSql) or die(mysqli_error($con));

            if (mysqli_affected_rows($con) > 0) {
                // set a notification 
                $sSql = "SELECT * FROM `tblnotify` WHERE `matric_no`= '{$matNo}' AND `courseId`= '{$cid}' AND `status`= '0'";
                $sQuery = mysqli_query($con, $sSql) or die(mysqli_error($con));
    
                if (mysqli_num_rows($sQuery) > 0) {
                    // if the notification already exist update it 
                    $chkSql = "UPDATE `tblnotify` SET `matric_no`='{$matNo}',`courseId`='{$cid}',`eventId`='1',`status`='0' WHERE `matric_no`= '{$matNo}' AND `courseId`= '{$cid}'";
                    $chkQuery = mysqli_query($con, $chkSql) or die(mysqli_error($con));
    
                    if (mysqli_affected_rows($con) > 0) {
                        return "Gpa set";
                    }
                } else {
                    // if the notification does not exist 
                    $notySql = "INSERT INTO `tblnotify` (`matric_no`, `courseId`, `eventId`, `status`) VALUES ('{$matNo}','{$cid}','1','0')";
                    $notyQuery = mysqli_query($con, $notySql) or die(mysqli_error($con));  
    
                    if (mysqli_affected_rows($con) > 0) {
                        return "Gpa Set";
                    }
                }
            }
        }
    } else {
        return "An error ocuured that's all we know";
    }
}

// function to calculate cgpa in second semester 
function setCgpa($matNo, $se, $q, $con, $lvl) {
    // get first semester result
    $cgpaSetSql= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'first' AND `session` = '{$se}' AND `status`= '1' AND `levelId`= $lvl";
    $cgpaSetQuery = mysqli_query($con, $cgpaSetSql) or die(mysqli_error($con)); 
    if (mysqli_num_rows($cgpaSetQuery) > 0) {
        $cgpaSetRows = mysqli_fetch_assoc($cgpaSetQuery);
        $fGpa = $cgpaSetRows['gpa'];

        // get second semester result 
        $cgpaSetSql2= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'second' AND `session` = '{$se}' AND `status`= '1' AND `levelId`= $lvl";
        $cgpaSetQuery2 = mysqli_query($con, $cgpaSetSql2) or die(mysqli_error($con));

        if (mysqli_num_rows($cgpaSetQuery2) > 0) {
            $cgpaSetRows2 = mysqli_fetch_assoc($cgpaSetQuery2);
            $sgpa = $cgpaSetRows2['gpa'];
            // get second semester cgpa  
            $cgpaF = ($fGpa + $sgpa)/2;
            $cgpa = floor($cgpaF * 100)/100;
            // update the student cgpa table in db 
            $cSqlgp = "UPDATE `studentsgpacgpa` SET `cgpa`= '{$cgpa}' WHERE matric_no = '{$matNo}' AND `session`= '{$se}' AND `semester`= 'second'";
            $cQuerygp = mysqli_query($con, $cSqlgp) or die(mysqli_error($con));
            if (mysqli_affected_rows($con) > 0) {
                return 'Cgpa Set';
            }
        } else {
            return 'Second semester not found';
        }
    } else {
        return 'First semester not found';
    }
}

// function to calculate cgpa for year two first semester
function setCgpa2($matNo, $se, $q, $con, $lvl) {
    // get the levelId of year one
    $oldLevel = $lvl - 1;
    // get first semester result
    $cgpaSetSql = "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'first' AND `session` <> '{$se}' AND `status`= '1' AND `levelId`= '{$oldLevel}'";
    // get second semester result
    $cgpaSetSql2 = "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'second' AND `session` <> '{$se}' AND `status`= '1' AND `levelId`= '{$oldLevel}'";
    // get the gpa of year two first semester
    $cgpaSetSql3 = "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'first' AND `session` = '{$se}' AND `status`= '1' AND `levelId`= '{$lvl}'";
    
    $cgpaSetQuery = mysqli_query($con, $cgpaSetSql) or die(mysqli_error($con));
    if (mysqli_num_rows($cgpaSetQuery) > 0) {
        $cgpaSetRows = mysqli_fetch_assoc($cgpaSetQuery);

        $cgpaSetQuery2 = mysqli_query($con, $cgpaSetSql2) or die(mysqli_error($con));
        if (mysqli_num_rows($cgpaSetQuery2) > 0) {
            $cgpaSetRows2 = mysqli_fetch_assoc($cgpaSetQuery2);

            $cgpaSetQuery3 = mysqli_query($con, $cgpaSetSql3) or die(mysqli_error($con));
            if (mysqli_num_rows($cgpaSetQuery3) > 0) {
                $cgpaSetRows3 = mysqli_fetch_assoc($cgpaSetQuery3);

                $totalCgpaF = ($cgpaSetRows['gpa'] + $cgpaSetRows2['gpa'] + $cgpaSetRows3['gpa'])/3;
                $totalCgpa = floor($totalCgpaF * 100)/100;
                // update the student cgpa table in db 
                $cSqlgpa = "UPDATE `studentsgpacgpa` SET `cgpa`= '{$totalCgpa}' WHERE matric_no = '{$matNo}' AND `session`= '{$se}' AND `semester`= 'first'";
                $cQuerygpa = mysqli_query($con, $cSqlgpa) or die(mysqli_error($con));
                if (mysqli_affected_rows($con) > 0) {
                    return 'Year Two Cgpa Set';
                }
            } else {
                return 'Year two first semester result not founnd';
            }
        } else {
            return 'Year one second semester result not found';
        }
    } else {
        return 'Year one first semester result not found';
    }
}

// function to calculate final cgpa
function finalCgpa($matNo, $se, $q, $con, $lvl) {
    // get the levelId of year one
    $oldLevel = $lvl - 1;
    // get year one second semester cgpa 
    $cgpaSetSql= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'second' AND `session` <> '{$se}' AND `status`= '1' AND `levelId`= '{$oldLevel}'";
    // get year two first and second semester gpa
    $cgpaSetSql2= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'first' AND `session` = '{$se}' AND `status`= '1' AND `levelId`= '{$lvl}'";
    $cgpaSetSql3= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'second' AND `session` = '{$se}' AND `status`= '1' AND `levelId`= '{$lvl}'"; 

    $cgpaSetQuery = mysqli_query($con, $cgpaSetSql) or die(mysqli_error($con));
    if (mysqli_num_rows($cgpaSetQuery) > 0) {
        $cgpaSetRows = mysqli_fetch_assoc($cgpaSetQuery);

        $cgpaSetQuery2 = mysqli_query($con, $cgpaSetSql2) or die(mysqli_error($con));
        if (mysqli_num_rows($cgpaSetQuery2) > 0) {
            $cgpaSetRows2 = mysqli_fetch_assoc($cgpaSetQuery2);

            $cgpaSetQuery3 = mysqli_query($con, $cgpaSetSql3) or die(mysqli_error($con));
            if (mysqli_num_rows($cgpaSetQuery3) > 0) {
                $cgpaSetRows3 = mysqli_fetch_assoc($cgpaSetQuery3);

                $totalCgpa = ($cgpaSetRows2['gpa'] + $cgpaSetRows3['gpa'])/2;
                $finalCgpaF = ($cgpaSetRows['cgpa'] + $totalCgpa)/2;
                $finalCgpa = floor($finalCgpaF * 100)/100;
                // update the student cgpa table in db 
                $cSqlgpa2 = "UPDATE `studentsgpacgpa` SET `cgpa`= '{$finalCgpa}' WHERE matric_no = '{$matNo}' AND `session`= '{$se}' AND `semester`= 'second'";
                $cQuerygpa2 = mysqli_query($con, $cSqlgpa2) or die(mysqli_error($con));

                if (mysqli_affected_rows($con) > 0) {
                    return 'Final Cgpa Set';
                }
            } else {
                return 'year two second semester result not found';
            }
        } else {
            return 'year two first semester result not found';
        }
    } else {
        return 'year one final cgpa not found';
    }
}
















