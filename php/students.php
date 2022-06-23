<?php
session_start();
require_once "../db/dbConnect.php";

// get the current session and semester of the school 
$cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
$cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

if (mysqli_num_rows($cQuery) > 0) {
    $seRows = mysqli_fetch_assoc($cQuery);
    $semes = $seRows['current_semester'];
    $sexion = $seRows['session'];

    // get the courseid from tblcourse by the lecturer id 
    $getCidSql = "SELECT * FROM  studentregcourses WHERE lecturerId = '{$_SESSION['unique_id']}'";
    $getCidQuery = mysqli_query($conn,$getCidSql) or die(mysqli_error($conn));

    if (mysqli_num_rows($getCidQuery) > 0) {

        function sql ($lec, $s, $se, $lvl) {
            return "SELECT srg.matric_no, st.firstname, st.middlename, st.lastname, st.program, srg.courseId FROM studentregcourses as srg JOIN tblcourses as sc ON srg.courseId = sc.id JOIN tblstudents as st ON st.matric_no = srg.matric_no WHERE srg.lecturerId = '{$lec}' AND srg.submit <> 1 AND srg.semester = '{$s}' AND srg.session = '{$se}' AND sc.levelId = $lvl";
        }

        // fucntion to search for student on keyUp 
        function student($q) {
            $out = '';

            if (mysqli_num_rows($q) > 0) {
                // set the number of ID
                $num = "1";
                while ($rows = mysqli_fetch_assoc($q)) {
                    $out .= 
                    '<tr class="takeCare">
                        <td>'. $num++ .'</td>
                        <td>'. $rows["matric_no"] .'</td>
                        <td>'. $rows["lastname"] ." ". $rows["firstname"]. " ". $rows["middlename"] .'</td>
                        <td>'. $rows["program"] .'</td>
                        <td><button id='. $rows["matric_no"] .' onclick="test(this)" class="submit">Score Student</button>
                        <input type="text" value='. $rows["courseId"] .' readonly hidden></td>
                    </tr>';
                }
            }
            return $out;
        }

        // fetching data from the students and coursereg table for ND1
        $sql = sql($_SESSION['unique_id'], $semes, $sexion, '1');

        // fetching data from the students and coursereg table for ND2
        $nsql = sql($_SESSION['unique_id'], $semes, $sexion, '2');

        // fetching data from the students and coursereg table for HND1
        $hsql = sql($_SESSION['unique_id'], $semes, $sexion, '3');

        // fetching data from the students and coursereg table for HND2
        $hnsql = sql($_SESSION['unique_id'], $semes, $sexion, '4'); 

        // for ND1 
        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $output = student($query);

        // for HND1 
        $hquery = mysqli_query($conn, $hsql) or die(mysqli_error($conn));
        $houtput = student($hquery);

        // for ND2 
        $nquery = mysqli_query($conn, $nsql) or die(mysqli_error($conn));
        $noutput = student($nquery);

        // for HND2 
        $hnquery = mysqli_query($conn, $hnsql) or die(mysqli_error($conn));
        $hnoutput = student($hnquery);


        echo $output . '-nd-'. $houtput . '-hnd-' . $noutput . '-nd2-' . $hnoutput . '-hnd2';
    }
}


    

    


