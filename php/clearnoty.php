<?php
session_start();
// get the database conn 
require_once "../db/dbConnect.php";

// fetch the last notification of this curent student 
$sql = "SELECT * FROM `tblnotify` WHERE `matric_no`= '{$_SESSION['unique_id']}' AND `status`= '0' ORDER BY date DESC LIMIT 1";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

if ($query) {
    $rows = mysqli_fetch_assoc($query);
    $id = $rows['id'];

    $upSql = "UPDATE `tblnotify` SET `status`= '1' WHERE matric_no = '{$_SESSION['unique_id']}' AND id = '{$id}'";
    $upQuery = mysqli_query($conn, $upSql) or die(mysqli_error($conn));

    if ($upQuery) {
        echo "notification seen";
    }
}