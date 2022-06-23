<?php
// get the database conn 
require_once "../db/dbConnect.php";

$matNo = mysqli_real_escape_string($conn, $_POST['matNo']);

if (!empty($matNo)) {
    // check if user exist 
    $chkSql = "SELECT * FROM `tblstudents` WHERE matric_no = '{$matNo}'";
    $chkQuery = mysqli_query($conn, $chkSql) or die(mysqli_error($conn));
    if (mysqli_num_rows($chkQuery) > 0) {
        
        // get the seesion and semester from session tbl 
        $seSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
        $seQuery = mysqli_query($conn, $seSql) or die(mysqli_error($conn));
        if (mysqli_num_rows($seQuery) > 0) {
            $seRows = mysqli_fetch_assoc($seQuery);
            $semester = $seRows['current_semester'];
            $session = $seRows['session'];

            $sql = "SELECT tlc.course_title, tlc.course_code FROM tblstudents as st JOIN tblcourses as tlc ON st.levelId = tlc.levelId WHERE tlc.semester = '{$semester}' AND tlc.session = '{$session}' AND tlc.levelId = st.levelId AND st.matric_no = '{$matNo}'";
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            $output = '';
            if (mysqli_num_rows($query) > 0) {
                while ($rows = mysqli_fetch_assoc($query)) {
                $output .= '
                    <tr>
                        <td><input type="checkbox" value="'. $rows['course_code'] .'"></td>
                        <td>'. $rows['course_title'] .'</td>
                        <td>'. $rows['course_code'] .'</td>
                    </tr>
                ';
                }
            }
            echo $output .'-'. $semester . '-' . $session;
        } 
    }
}
