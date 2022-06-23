<?php
    session_start();
    if (!isset($_SESSION['unique_id'])) {
        header("Location: ../index.php");
    }

    // get the php database file
    include_once "db/dbConnect.php";

       // get the current user from the student details database 
       $sql = "SELECT l.level, l.numeric_value, t.matric_no, t.firstname, t.middlename, t.lastname, t.img_name FROM tblstudents as t JOIN tbllevels as l ON t.levelId = l.id WHERE t.matric_no = '{$_SESSION['unique_id']}'";

       $query = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($query) > 0) {
           $rows = mysqli_fetch_assoc($query);
       }

       // get the current user from the lecturer details database 
       $sqlII = "SELECT * FROM tbllecturers WHERE unique_id = '{$_SESSION['unique_id']}'";

       $queryII = mysqli_query($conn, $sqlII);
   
       if (mysqli_num_rows($queryII) > 0) {
           $rowsII = mysqli_fetch_assoc($queryII);
       }

       // get the current user from the admin details database 
       $sqlIII = "SELECT * FROM tbladmin WHERE unique_id = '{$_SESSION['unique_id']}'";

       $queryIII = mysqli_query($conn, $sqlIII);
   
       if (mysqli_num_rows($queryIII) > 0) {
           $rowsIII = mysqli_fetch_assoc($queryIII);
       }

       // get the current user from the superadmin details database 
       $sqlIV = "SELECT * FROM tblsuperadmin WHERE unique_id = '{$_SESSION['unique_id']}'";

       $queryIV = mysqli_query($conn, $sqlIV);
   
       if (mysqli_num_rows($queryIV) > 0) {
           $rowsIV = mysqli_fetch_assoc($queryIV);
       }

        // get the current session and semester of the school 
        $cSql = "SELECT * FROM `tblsession` ORDER BY id DESC LIMIT 1";
        $cQuery = mysqli_query($conn, $cSql) or die(mysqli_error($conn));

        if (mysqli_num_rows($cQuery) > 0) {
            $seRows = mysqli_fetch_assoc($cQuery);
        }
    
