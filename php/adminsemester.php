<?php

require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

function sql($s, $se, $lvl)  {
    return "SELECT tr.matric_no, stu.lastname, stu.firstname, stu.middlename, stu.program, sc.course_code, tr.CourseId, tr.marks FROM tblstudents AS stu JOIN tblresult as tr ON stu.matric_no = tr.matric_no JOIN tblcourses as sc ON tr.courseId = sc.id WHERE tr.submit = 1 AND tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl";
}

function query($q) {
    $out = '';
        if (mysqli_num_rows($q) > 0) {
            // set the number of ID
            $num = "1";
            while ($rows = mysqli_fetch_assoc($q)) {
                $out .= 
                '<tr>
                    <td>'. $num++ .'</td>
                    <td>'. $rows["matric_no"] .'</td>
                    <td>'. $rows["lastname"] ." ". $rows["firstname"]. " ". $rows["middlename"] .'</td>
                    <td>'. $rows["program"] .'</td>
                    <td>' .$rows["course_code"] .'</td>
                    <td><input type="text" name="" maxlength="3" value="'. $rows["marks"].'" readonly></td>
                    <td><button id='. $rows["matric_no"] . "-" . $rows["CourseId"] .' onclick="test(this)" class="submit">upload</button></td>
                </tr>';
            }
        }
    return $out;
}


// fetching data from the students table 
if (mysqli_num_rows($cQuery) > 0) {
    $sRows = mysqli_fetch_assoc($cQuery);
    $semes = $sRows['current_semester'];
    $sexion = $sRows['session'];

    // sql for nd1
    $sql = sql($semes, $sexion, '1'); 

    // sql for hnd1
    $hsql = sql($semes, $sexion, '3'); 

    // sql for nd2
    $nsql = sql($semes, $sexion, '2'); 

    // sql for hnd2
    $hnsql = sql($semes, $sexion, '4'); 

    // for nd1 
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $output = query($query);
    
    // for hnd1 
    $hquery = mysqli_query($conn, $hsql) or die(mysqli_error($conn));
    $houtput = query($hquery);

    // for nd2
    $nquery = mysqli_query($conn, $nsql) or die(mysqli_error($conn));
    $noutput = query($nquery);

    // for hnd2
    $hnquery = mysqli_query($conn, $hnsql) or die(mysqli_error($conn));
    $hnoutput = query($hnquery);

    echo $output . '_nd_' . $houtput . '_hnd_' . $noutput . '_nd2_'. $hnoutput . '_hnd2';
}




