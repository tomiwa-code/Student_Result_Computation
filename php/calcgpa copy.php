<?php

// get the database conn 
require_once "../db/dbConnect.php";

function setGp($matNo, $se, $q, $con, $cid, $s) {
    // check if gpa is set to know who is in first year or first semester 
    $gpSql = "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= '{$s}' AND `session`= '{$se}' AND `levelId`= '{$cid}'";
    $gpQuery = mysqli_query($con, $gpSql) or die(mysqli_error($con));
    if (mysqli_num_rows($gpQuery) > 0) {
        // declare variable for course unit and credit point
        $totalCourseUnit = 0;
        $totalCreditPoint =  0.00;
        while ($rows= mysqli_fetch_assoc($q)) {
            $totalCourseUnit += $rows['course_unit']; 
            $totalCreditPoint += $rows['creditPoint'];
        }

        if ($totalCourseUnit != 0) {
            // gpa and cgpa of this current student 
            $gpaF = $totalCreditPoint / $totalCourseUnit;
            $gpa = floor($gpaF*100)/100;
            // update the student gpa and cgpa table in db 
            $cSql = "UPDATE `studentsgpacgpa` SET `gpa`= '{$gpa}', `cgpa`= '{$gpa}', `courseUnit` = '{$totalCourseUnit}', `creditPoints`= '{$totalCreditPoint}', `status`= '1' WHERE matric_no = '{$matNo}' AND `session`= '{$se}' AND `semester`= '{$s}'";
            $cQuery = mysqli_query($con, $cSql) or die(mysqli_error($con));
    
            if ($cQuery) {
                // set a notification 
                $sSql = "SELECT * FROM `tblnotify` WHERE `matric_no`= '{$matNo}' AND `courseId`= '{$cid}' AND `status`= '0'";
                $sQuery = mysqli_query($con, $sSql) or die(mysqli_error($con));
    
                if (mysqli_num_rows($sQuery) > 0) {
                    // if the notification already exist update it 
                    $chkSql = "UPDATE `tblnotify` SET `matric_no`='{$matNo}',`courseId`='{$cid}',`eventId`='1',`status`='0' WHERE `matric_no`= '{$matNo}' AND `courseId`= '{$cid}'";
                    $chkQuery = mysqli_query($con, $chkSql) or die(mysqli_error($con));
    
                    if ($chkQuery) {
                        return "Gpa set";
                    }
                } else {
                    // if the notification does not exist 
                    $notySql = "INSERT INTO `tblnotify` (`matric_no`, `courseId`, `eventId`, `status`) VALUES ('{$matNo}','{$cid}','1','0')";
                    $notyQuery = mysqli_query($con, $notySql) or die(mysqli_error($con));  
    
                    if ($notyQuery) {
                        return "Gpa Set";
                    }
                }
            }
        }
    } else {
        return "An error ocuured that's all we know";
    }
}

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
        if (mysqli_num_rows($cgpaSetQuery) > 0) {
            $cgpaSetRows2 = mysqli_fetch_assoc($cgpaSetQuery2);
            $sCgpa = $cgpaSetRows2['gpa'];
            // gpa and cgpa of this current student 
            $cgpaF = ($fGpa + $sCgpa)/2;
            $cgpa = floor($cgpaF * 100)/100;
            // update the student cgpa table in db 
            $cSqlgp = "UPDATE `studentsgpacgpa` SET `cgpa`= '{$cgpa}' WHERE matric_no = '{$matNo}' AND `session`= '{$se}' AND `semester`= 'second'";
            $cQuerygp = mysqli_query($con, $cSqlgp) or die(mysqli_error($con));
            if ($cQuerygp) {
                return 'Cgpa Set';
            }
        }  else {
            return "second semester not available";
        }
    } else {
        return "first semester not available";
    }
}

// function to set cgpa for year two 
function setCgpa2($matNo, $se, $q, $con, $lvl) {
    // get the levelId of year one
    $oldLevel = $lvl - 1;
    // get first semester result
    $cgpaSetSql= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'first' AND `session` <> '{$se}' AND `status`= '1' AND `levelId`= '{$oldLevel}'";
    // get second semester result
    $cgpaSetSql2= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'second' AND `session` <> '{$se}' AND `status`= '1' AND `levelId`= '{$oldLevel}'";
    // get the this level gpa 
    $cgpaSetSql3= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'first' AND `session` = '{$se}' AND `status`= '1' AND `levelId`= '{$lvl}'";

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
                if ($cQuerygpa) {
                    return 'Year Two Cgpa Set';
                }
            } else {
                return 'ND2 first semester result not found';
            }
        } else {
            return 'ND1 second semester result not found';
        }
    } else {
        return 'ND1 first semester result not found';
    }
}

// year two final cgpa 
function finalCgpa($matNo, $se, $q, $con, $lvl) {
    // get the levelId of year one
    $oldLevel = $lvl - 1;
    // get second semester result
    $cgpaSetSql= "SELECT * FROM `studentsgpacgpa` WHERE `matric_no`= '{$matNo}' AND `semester`= 'second' AND `session` <> '{$se}' AND `status`= '1' AND `levelId`= '{$oldLevel}'";
    // get the this level gpa 
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
                if ($cQuerygpa2) {
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

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

$matric_no = mysqli_real_escape_string($conn, $_POST['matric_no']);
$courseId = mysqli_real_escape_string($conn, $_POST['courseId']);

// if the datas from js are not empty 
if (!empty($matric_no) && !empty($courseId)) {

    if (mysqli_num_rows($cQuery) > 0) {
        $sRows = mysqli_fetch_assoc($cQuery);
        $semes = $sRows['current_semester'];
        $sexion = $sRows['session'];

        // fetching the student result from db 
        $sql = "SELECT sc.course_unit, tr.creditPoint, tr.semester, tr.levelId FROM tblresult as tr JOIN tblcourses as sc ON sc.id = tr.courseId WHERE matric_no = '{$matric_no}' AND tr.upload = 1 AND tr.semester = '{$semes}' AND tr.session = '{$sexion}'";
        // query the database 
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // if query was a success 
        if (mysqli_num_rows($query) > 0) {
            // for all first semester
            setGp($matric_no, $sexion, $query, $conn, $courseId, $semes);
            setCgpa($matric_no, $sexion, $query, $conn, '1');
            setCgpa($matric_no, $sexion, $query, $conn, '3');
            setCgpa2($matric_no, $sexion, $query, $conn, '2');
            setCgpa2($matric_no, $sexion, $query, $conn, '4');
            finalCgpa($matric_no, $sexion, $query, $conn, '2');
            finalCgpa($matric_no, $sexion, $query, $conn, '4');
        }
    } 
}












