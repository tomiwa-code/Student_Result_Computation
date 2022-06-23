<?php

    // get the database conn 
    require_once "../db/dbConnect.php";

    // get the current session and semester of the school 
    $cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
    $cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

    function sql($s, $se, $lvl, $si) {
        return "SELECT tr.matric_no, stu.lastname, stu.firstname, stu.middlename, stu.program, sc.course_code, tr.CourseId, tr.marks FROM tblstudents AS stu JOIN tblresult as tr ON stu.matric_no = tr.matric_no JOIN tblcourses as sc ON tr.courseId = sc.id WHERE tr.submit = 1 
        AND tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND stu.firstname LIKE '%{$si}%'
        OR tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND stu.middlename LIKE '%{$si}%'
        OR tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND stu.lastname LIKE '%{$si}%'
        OR tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND stu.program LIKE '%{$si}%'
        OR tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND sc.course_code LIKE '%{$si}%'
        OR tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND tr.marks LIKE '%{$si}%'
        OR tr.upload <> 1 AND tr.semester = '{$s}' AND tr.session = '{$se}' AND tr.levelId = $lvl AND tr.matric_no LIKE '%{$si}%'";
    }

    function student($q) {
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

    // get the search input from js 
    $searchInput = mysqli_real_escape_string($conn, $_POST['searchInput']);

    // check if the input is empty
    if (!empty($searchInput)) {
        
        // fetching data from the students table 
        if (mysqli_num_rows($cQuery) > 0) {
            $sRows = mysqli_fetch_assoc($cQuery);
            $semes = $sRows['current_semester'];
            $sexion = $sRows['session'];

            // fetch data of the student from nd1 
            $sql = sql($semes, $sexion, '1', $searchInput);

            // fetch data of the student from hnd1 
            $hsql = sql($semes, $sexion, '3', $searchInput);

            // fetch data of the student from nd2 
            $nsql = sql($semes, $sexion, '2', $searchInput);

            // fetch data of the student from hnd2
            $hnsql = sql($semes, $sexion, '4', $searchInput);
            
            // for nd1 
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $output = student($query);

            // for hnd1 
            $hquery = mysqli_query($conn, $hsql) or die(mysqli_error($conn));
            $houtput = student($hquery);

            // for nd2 
            $nquery = mysqli_query($conn, $nsql) or die(mysqli_error($conn));
            $noutput = student($nquery);

            // for hnd2 
            $hnquery = mysqli_query($conn, $hnsql) or die(mysqli_error($conn));
            $hnoutput = student($hnquery);

            echo $output . '_nd_' . $houtput . '_hnd_' . $noutput . '_nd2_'. $hnoutput . '_hnd2';
        }        
    }
     

    
        