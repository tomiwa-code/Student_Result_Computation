<?php

// get the database conn 
require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

$searchVal = mysqli_real_escape_string($conn, $_POST['searchInput']);
$sexion = mysqli_real_escape_string($conn, $_POST['sexion']);

// check if the value is not empty  
if (!empty($searchVal)) {
    if (mysqli_num_rows($cQuery) > 0) {
        $seRows = mysqli_fetch_assoc($cQuery);
        $semes = $seRows['current_semester'];

        function sql($con, $s, $se, $lvl, $sv) {
            $sql = "SELECT st.matric_no, st.firstname, st.lastname, st.middlename, tr.gpa, tr.cgpa FROM tblstudents as st JOIN studentsgpacgpa as tr ON tr.matric_no = st.matric_no WHERE 
            tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= $lvl AND st.matric_no LIKE '%{$sv}%' 
            OR tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= $lvl AND st.firstname LIKE '%{$sv}%' 
            OR tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= $lvl AND st.lastname LIKE '%{$sv}%' 
            OR tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= $lvl AND st.middlename LIKE '%{$sv}%' 
            OR tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= $lvl AND tr.gpa LIKE '%{$sv}%' 
            OR tr.semester = '{$s}' AND tr.session= '{$se}' AND tr.levelId= $lvl AND tr.cgpa LIKE '%{$sv}%' 
            ORDER BY st.matric_no";
            // query the database 
            $query = mysqli_query($con, $sql) or die(mysqli_error($con));

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

        $output = sql($conn, $semes, $sexion, '1', $searchVal);
        $houtput = sql($conn, $semes, $sexion, '3', $searchVal);
        $noutput = sql($conn, $semes, $sexion, '2', $searchVal);
        $hnoutput = sql($conn, $semes, $sexion, '4', $searchVal);
        echo $output . '-nd-'. $houtput . '-hnd-'. $noutput . '-nd2-'. $houtput . '-hnd2';
    }
}