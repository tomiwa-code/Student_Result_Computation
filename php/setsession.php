<?php
// get the database conn 
require_once "../db/dbConnect.php";

$session = mysqli_real_escape_string($conn, $_POST['session']);
$semester = mysqli_real_escape_string($conn, $_POST['semester']);

if (!empty($session) && !empty($session)) {
    $sql = "INSERT INTO `tblsession`(`session`, `current_semester`) VALUES ('{$session}','{$semester}')";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // check if the year already existed in tblsessiony 
    $sesSql = "SELECT * FROM `tblsessiony` WHERE `session`= '{$session}'";
    $sesQuery = mysqli_query($conn, $sesSql) or die(mysqli_error($conn));
    if (!mysqli_num_rows($sesQuery) > 0) {
        // insert the session to tblsessiony 
        $inSql = "INSERT INTO `tblsessiony`(`session`) VALUES ('{$session}')";
        $inQuery =  mysqli_query($conn, $inSql) or die(mysqli_error($conn));
        if ($inQuery) {
            echo "Session, semester and year is set successfully!";
        }
    } else {
        echo "Session and semester is set successfully!";
    }
}
