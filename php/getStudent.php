<?php
session_start();
require_once "../db/dbConnect.php";

function sql($user, $s, $lvl, $con) {
    $sql = "SELECT st.firstname, st.middlename, st.lastname, st.matric_no, tr.session, tr.semester FROM tblstudents as st JOIN tblresult as tr ON tr.matric_no = st.matric_no WHERE st.matric_no = '{$user}' AND tr.semester = '{$s}' AND tr.levelId = $lvl";
    $query = mysqli_query($con, $sql) or die(mysqli_error($con));

    if (mysqli_num_rows($query) > 0) {
        $rows = mysqli_fetch_assoc($query);
        $full_name = $rows['lastname'] . ' ' . $rows['firstname'] . ' ' . $rows['middlename'];
        $result_year = $rows['session'];
        $mat_no = $rows['matric_no'];
        $secs = $rows['semester'];

        return $full_name . '_' . $result_year . '_' . $mat_no . '_' . $secs;
    }
}

$semes = mysqli_real_escape_string($conn, $_POST['semes']);
$stulvl = mysqli_real_escape_string($conn, $_POST['stulvl']);

$output = sql($_SESSION['unique_id'], $semes, $stulvl, $conn);       

echo $output;
