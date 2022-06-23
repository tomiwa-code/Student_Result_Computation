<?php

// get the database conn 
require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

$cId = mysqli_real_escape_string($conn, $_POST['cId']);
$matNo = mysqli_real_escape_string($conn, $_POST['matNo']);
$sexion = mysqli_real_escape_string($conn, $_POST['sexion']);

// check if the value is not empty  
if (!empty($cId) && !empty($matNo)) { 
    if (mysqli_num_rows($cQuery) > 0) {
        $seRows = mysqli_fetch_assoc($cQuery);
        $semes = $seRows['current_semester']; 
    
        // set the submit and upload to 0 in table result 
        $trSql = "UPDATE `tblresult` SET `creditPoint`= '0', `submit`= '0',`upload`= '0',`edit`= '1' WHERE matric_no = '{$matNo}' AND courseId = '{$cId}' AND `semester`='{$semes}' AND `session`='{$sexion}'";
        $trQuery = mysqli_query($conn, $trSql) or die(mysqli_error($conn));

        if ($trQuery) {
            // set the submit and upload to 0 in table courseReg
            $crSql = "UPDATE `studentregcourses` SET `submit`= '0',`upload`= '0',`edit`= '1' WHERE matric_no = '{$matNo}' AND courseId = '{$cId}' AND `semester`='{$semes}' AND `session`='{$sexion}'";
            $crQuery = mysqli_query($conn, $crSql) or die(mysqli_error($conn));

            if ($crQuery) {
                // set the status of gpacgpa table to zero 
                $rcSqlgpa = "UPDATE `studentsgpacgpa` SET `status`= '0' WHERE matric_no = '{$matNo}' AND semester= '{$semes}' AND `session`='{$sexion}'";
                $rcQuerygpa = mysqli_query($conn, $rcSqlgpa) or die(mysqli_error($conn)); 

                if ($rcQuerygpa) {
                    // get the unit of this current course 
                    $getuSql = "SELECT * FROM `tblcourses` WHERE id = '{$cId}'";
                    $getuQuery = mysqli_query($conn, $getuSql) or die(mysqli_error($conn));
    
                    if (mysqli_num_rows($getuQuery) > 0) {
                        $rows = mysqli_fetch_assoc($getuQuery);
                        $cUnit = $rows['course_unit'];
        
                        // get the current total courseUnit 
                        $ctuSql = "SELECT * FROM `studentsgpacgpa` WHERE matric_no = '{$matNo}' AND `semester`= '{$semes}' AND `session`= '{$sexion}'";
                        $ctuQuery = mysqli_query($conn, $ctuSql) or die(mysqli_error($conn));

                        if (mysqli_num_rows($ctuQuery) > 0) {
                            $cRows = mysqli_fetch_assoc($ctuQuery);
                            $oUnit = $cRows['courseUnit'];
                            $newUnit = $oUnit - $cUnit;

                            if ($newUnit >= 0) {
                                // upload the new unit 
                                $upSql = "UPDATE `studentsgpacgpa` SET `courseUnit`= '{$newUnit}' WHERE matric_no = '{$matNo}' AND `semester`= '{$semes}' AND `session`= '{$sexion}'";
                                $upQuery = mysqli_query($conn, $upSql) or die(mysqli_error($conn));

                                if ($upQuery) {
                                    // fetching the student result from db 
                                    $sql = "SELECT tr.creditPoint FROM tblresult as tr JOIN tblcourses as sc ON sc.id = tr.courseId WHERE matric_no = '{$matNo}' AND tr.upload = 1 AND tr.semester = '{$semes}' AND tr.session = '{$sexion}'";
        
                                    // query the database 
                                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                                     // declare variable for credit point
                                    $totalCreditPoint =  0.00;

                                    // if query was a success 
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($rows = mysqli_fetch_assoc($query)) { 
                                            $totalCreditPoint += $rows['creditPoint'];
                                        };
                                    }
    
                                    // check if the total course unit is not 0 
                                    if ($newUnit != 0) {
                                        // gpa and cgpa of this current student 
                                        $gpaF = $totalCreditPoint / $newUnit;
                                        $gpa = floor($gpaF*100)/100;
                                        // update the student gpa and cgpa table in db 
                                        $cSql = "UPDATE `studentsgpacgpa` SET `gpa`= '{$gpa}', `cgpa`= '{$gpa}', `courseUnit` = '{$newUnit}'   WHERE matric_no = '{$matNo}' AND `session`= '{$semes}' AND `semester`= '{$sexion}'";
                                        $cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));
                                        if ($cQuery) {  
                                            echo "Allowed";
                                        }
                                    } else {
                                        $rcSql = "UPDATE `studentsgpacgpa` SET `gpa`= '0.00', `cgpa`= '0.00', `courseUnit` = '0', `status`= '0' WHERE matric_no = '{$matNo}' AND semester= '{$semes}' AND `session`='{$sexion}'";
                                        $rcQuery = mysqli_query($conn, $rcSql) or die(mysqli_error($conn)); 

                                        if ($rcQuery) {
                                            // update the notify table in db 
                                            $notySql = "DELETE FROM `tblnotify` WHERE `matric_no` = '{$matNo}' AND `courseId` = '{$cId}'";
                                            $notyQuery = mysqli_query($conn, $notySql) or die(mysqli_error($conn));
    
                                            if ($notyQuery) {
                                                echo "Allowed";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

// // check if the value is not empty  
// if (!empty($cId) && !empty($matNo)) { 
//     // set the submit and upload to 0 in table result 
//     $trSql = "UPDATE `tblresult` SET `creditPoint`= '0', `submit`= '0',`upload`= '0',`edit`= '1' WHERE matric_no = '{$matNo}' AND courseId = '{$cId}'";
//     $trQuery = mysqli_query($conn, $trSql) or die(mysqli_error($conn));

//     if ($trQuery) {
//         // set the submit and upload to 0 in table courseReg
//         $crSql = "UPDATE `studentregcourses` SET `submit`= '0',`upload`= '0',`edit`= '1' WHERE matric_no = '{$matNo}' AND courseId = '{$cId}'";
//         $crQuery = mysqli_query($conn, $crSql) or die(mysqli_error($conn));

//         if ($crQuery) {
//             // get the unit of this current course 
//             $getuSql = "SELECT * FROM `tblcourses` WHERE id = '{$cId}'";
//             $getuQuery = mysqli_query($conn, $getuSql) or die(mysqli_error($conn));

//             if (mysqli_num_rows($getuQuery) > 0) {
//                 $rows = mysqli_fetch_assoc($getuQuery);
//                 $cUnit = $rows['course_unit'];

//                 // get the current total courseUnit 
//                 $ctuSql = "SELECT * FROM `studentsgpacgpa` WHERE matric_no = '{$matNo}'"; // edit this line 
//                 $ctuQuery = mysqli_query($conn, $ctuSql) or die(mysqli_error($conn));

//                 if (mysqli_num_rows($ctuQuery) > 0) {
//                     $cRows = mysqli_fetch_assoc($ctuQuery);
//                     $oUnit = $cRows['courseUnit'];
//                     $newUnit = $oUnit - $cUnit;

//                     if ($newUnit >= 0) {
//                         // upload the new unit 
//                         $upSql = "UPDATE `studentsgpacgpa` SET `courseUnit`= '{$newUnit}' WHERE matric_no = '{$matNo}'"; // edit this line
//                         $upQuery = mysqli_query($conn, $upSql) or die(mysqli_error($conn));

//                         if ($upQuery) {
//                             // fetching the student result from db 
//                             $sql = "SELECT tr.creditPoint FROM tblresult as tr JOIN tblcourses as sc ON sc.id = tr.courseId WHERE matric_no = '{$matNo}' AND tr.upload = 1"; // edit this line

//                             // query the database 
//                             $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

//                             // declare variable for credit point
//                             $totalCreditPoint =  0.00;

//                             // if query was a success 
//                             if (mysqli_num_rows($query) > 0) {
//                                 while ($rows = mysqli_fetch_assoc($query)) { 
//                                     $totalCreditPoint += $rows['creditPoint'];
//                                 };
//                             }

//                             // check if the total course unit is not 0 
//                             if ($newUnit != 0) {
//                                 // gpa and cgpa of this current student 
//                                 $gpa = round($totalCreditPoint / $newUnit, 2);
//                                 // update the student gpa and cgpa table in db 
//                                 $cSql = "UPDATE `studentsgpacgpa` SET `gpa`= '{$gpa}', `cgpa`= '{$gpa}', `courseUnit` = '{$newUnit}', `semester`= 'first' WHERE matric_no = '{$matNo}'";
//                                 $cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

//                                 if ($cQuery) {  
//                                     echo "Allowed";
//                                 }
//                             } else {
//                                 $rcSql = "UPDATE `studentsgpacgpa` SET `gpa`= '0.00', `cgpa`= '0.00', `courseUnit` = '0' WHERE matric_no = '{$matNo}'";
//                                 $rcQuery = mysqli_query($conn, $rcSql) or die(mysqli_error($conn));

//                                 if ($rcQuery) {
//                                     // update the notify table in db 
//                                     $notySql = "DELETE FROM `tblnotify` WHERE `matric_no` = '{$matNo}' AND `courseId` = '{$cId}'";
//                                     $notyQuery = mysqli_query($conn, $notySql) or die(mysqli_error($conn));

//                                     if ($notyQuery) {
//                                         echo "Allowed";
//                                     }
//                                 }
//                             }
//                         }
//                     }
//                 }
//             }
//         }
//     }
// }