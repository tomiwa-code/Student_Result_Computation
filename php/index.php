<?php
    // start the seesion 
    session_start();
    // load in the database 
    require_once "../db/dbConnect.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    // check if all input are empty 
    if(!empty($email) && !empty($pass)) {

        // check if email is valid 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // if the user is student 
            $sql = "SELECT * FROM tblstudents WHERE email = '{$email}'";

            // if the user is lecturer 
            $sqlII = "SELECT * FROM tbllecturers WHERE email = '{$email}'";

            // if the user is admin
            $sqlIII = "SELECT * FROM tbladmin WHERE email = '{$email}'";

            // if the user is admin
            $sqlIV = "SELECT * FROM tblsuperadmin WHERE email = '{$email}'";

            // if the user is student
            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if (mysqli_num_rows($query) > 0) {
                    $rows = mysqli_fetch_assoc($query);

                    // check if password is correct 
                    $cpass = $rows['password'];
                    $unique_id = $rows['matric_no'];
                    if ($pass == $cpass) {
                        $_SESSION['unique_id'] = $unique_id;
                        echo "student";
                    } else{
                        echo "Incorrect Password";
                    }
                } else {
                    // if the user is lecturer
                    $queryII = mysqli_query($conn, $sqlII);
                    if (mysqli_num_rows($queryII) > 0) {
                        $rowsII = mysqli_fetch_assoc($queryII); 

                        // check if password is correct 
                        $cpass = $rowsII['password'];
                        $unique_id = $rowsII['unique_id'];
                        if ($pass == $cpass) {
                            $_SESSION['unique_id'] = $unique_id;
                            echo "lecturer";
                        } else{
                            echo "Incorrect Password";
                        }
                    } else {
                        // if the user is admin
                        $queryIII = mysqli_query($conn, $sqlIII);
                        if (mysqli_num_rows($queryIII) > 0) {
                            $rowsIII = mysqli_fetch_assoc($queryIII); 

                            // check if password is correct 
                            $cpass = $rowsIII['password'];
                            $unique_id = $rowsIII['unique_id'];
                            if ($pass == $cpass) {
                                $_SESSION['unique_id'] = $unique_id;
                                echo "admin";
                            } else{
                                echo "Incorrect Password";
                            }
                        } else {
                            // if the user is superadmin
                            $queryIV= mysqli_query($conn, $sqlIV);
                            if (mysqli_num_rows($queryIV) > 0) {
                                $rowsIV = mysqli_fetch_assoc($queryIV); 

                                // check if password is correct 
                                $cpass = $rowsIV['password'];
                                $unique_id = $rowsIV['unique_id'];
                                if ($pass == $cpass) {
                                    $_SESSION['unique_id'] = $unique_id;
                                    echo "superadmin";
                                } else{
                                    echo "Incorrect Password";
                                }
                            } else {
                                echo "Incorrect Email";
                            }
                        }
                    }
                }
        } else {
            echo "Email is not valid";
        }
    } else {
        echo "Please fill in all required fields";
    }