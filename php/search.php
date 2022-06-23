<?php
session_start();
require_once "../db/dbConnect.php";

// get the search input from js 
$searchInput = mysqli_real_escape_string($conn, $_POST['searchInput']);

// check if the input is empty
if (!empty($searchInput)) {

    // // get the current session and semester of the school 
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

            // function to get studnt on search 
            function sql ($s, $se, $lvl, $si) {
                return "SELECT srg.matric_no, st.firstname, st.middlename, st.lastname, st.program FROM tblstudents as st JOIN studentregcourses as srg on st.matric_no = srg.matric_no WHERE srg.submit <> 1 
                AND srg.semester = '{$s}' AND srg.session= '{$se}' AND st.levelId = '$lvl' AND st.firstname LIKE '%{$si}%' 
                OR srg.semester = '{$s}' AND srg.session= '{$se}' AND st.levelId = '$lvl' AND st.middlename LIKE '%{$si}%' 
                OR srg.semester = '{$s}' AND srg.session= '{$se}' AND st.levelId = '$lvl' AND st.lastname LIKE '%{$si}%' 
                OR srg.semester = '{$s}' AND srg.session= '{$se}' AND st.levelId = '$lvl' AND st.program LIKE '%{$si}%' 
                OR srg.semester = '{$s}' AND srg.session= '{$se}' AND st.levelId = '$lvl' AND srg.matric_no LIKE '%{$si}%'";
            }

            // fucntion to search for student on keyUp 
            function search($q) {
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
                            <input type="text" value='. $rows["matric_no"] .' readonly hidden></td>
                        </tr>';
                    }
                }
                return $out;
            }

            // fetching data from the students and coursereg table for ND1
            $sql = sql($semes, $sexion, 1, $searchInput);

            // fetching data from the students and coursereg table for HND1
            $hsql = sql($semes, $sexion, 3, $searchInput);

            // fetching data from the students and coursereg table for ND2
            $nsql = sql($semes, $sexion, 2, $searchInput);

            // fetching data from the students and coursereg table for HND2
            $hnsql = sql($semes, $sexion, 4, $searchInput);

            // for ND1
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $output = search($query);

            // for HND1 
            $hquery = mysqli_query($conn, $hsql) or die(mysqli_error($conn));
            $houtput = search($hquery);

            // for ND2
            $nquery = mysqli_query($conn, $nsql) or die(mysqli_error($conn));
            $noutput = search($nquery);

            // for HND1 
            $hnquery = mysqli_query($conn, $hnsql) or die(mysqli_error($conn));
            $houtput2 = search($hnquery);

            echo $output . '-nd-' . $houtput . '-hnd-' . $noutput . '-nd2-' . $houtput2 . '-hnd2';
            
        }
    }
}

