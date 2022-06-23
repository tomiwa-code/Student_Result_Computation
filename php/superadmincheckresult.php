<?php

// get the database conn 
require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));
// get the session the super admin want to see 
$sexion = mysqli_real_escape_string($conn, $_POST['sexion']);

if (mysqli_num_rows($cQuery) > 0) {
    $seRows = mysqli_fetch_assoc($cQuery);
    $semes = $seRows['current_semester'];

    // fetching the student result from db 
    function sql($con, $s, $se, $lvl) {
        $holdSql = "SELECT st.matric_no, st.firstname, st.lastname, st.middlename, tr.gpa, tr.cgpa FROM tblstudents as st JOIN studentsgpacgpa as tr ON tr.matric_no = st.matric_no WHERE tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= {$lvl} ORDER BY st.matric_no";

        $query = mysqli_query($con, $holdSql) or die(mysqli_error($con));
        if (mysqli_num_rows($query) > 0) {
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
                            <td>'. $rows["matric_no"] .'</td>
                            <td>'. $rows["lastname"] ." ". $rows["firstname"]. " ". $rows["middlename"] .'</td>
                            <td>'. $rows["gpa"].'</td>
                            <td>'. $rows["cgpa"] .'</td>
                            <td><button id="'. $rows["matric_no"] .'" onClick="vResult(this)">View Result</button></td>
                        </tr>
                    ';
                }
            }
            return $output;
        }
    }
    
    $output = sql($conn, $semes, $sexion, '1');
    $houtput = sql($conn, $semes, $sexion, '3');
    $noutput = sql($conn, $semes, $sexion, '2');
    $hnoutput = sql($conn, $semes, $sexion, '4');
    echo $output . '_nd_'. $houtput . '_hnd_'. $noutput . '_nd2_'. $hnoutput . '_hnd2';
}







