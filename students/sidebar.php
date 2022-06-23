<div class="studentSideBar">
            <div class="mapolyDetails">
                <img src="../img/mapoly-logo.png" alt="mapoly-logo">
                <div class="details">
                    <h3>Moshood abiola polytechnic (mapoly)</h3>
                </div>
            </div>

            <div class="studntDetails">
                <div class="holdImage">
                    <img src="../img/<?php echo $rows['img_name']?>" alt="studentImg">
                </div>
                <div class="details">
                    <h3 class="name"><?php echo $rows['lastname']." ".$rows['firstname']." ". $rows['middlename'] ?></h3>
                    <h2 class="matricNo"><?php echo $rows['matric_no']?></h2>
                    <p class="level"><?php echo $rows['level']. ' ' . $rows['numeric_value'];?>  full time</p>
                </div>
            </div>

            <div class="studentDash">
                <div class="section">
                    <h3 class="title">
                        Department
                    </h3>
                    <div class="iconDept">
                        <div class="text tmust">
                            <span class="fa fa-cubes"></span>
                            <h1 class="dept">Computer Science</h1>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h3 class="title">
                        Main
                    </h3>
                    <div class="iconDept dashboard active">
                        <div class="text active">
                            <span class="fa fa-dashcube"></span>
                            <li><a class="active" href="studentgui.php">Dashboard</a></li>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <h3 class="title">
                        Levels
                    </h3>
                    <div class="oldStudentResult">
                        <div class="levels nd1">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <h1 class="dept">ND 1</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="yearonefirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="yearonesecondsemester.php">Semester 2</a></li>
                        </div>
                         <div class="levels nd2">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star second"></span>
                                    <h1 class="dept">ND 2</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="yeartwofirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="yeartwosecondsemester.php">Semester 2</a></li>
                        </div>  

                        <div class="levels hnd1">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <h1 class="dept">HND 1</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="hndyearonefirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="hndyearonesecondsemester.php">Semester 2</a></li>
                        </div>
                         <div class="levels hnd2">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star second"></span>
                                    <h1 class="dept">HND 2</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="hndyeartwofirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="hndyeartwosecondsemester.php">Semester 2</a></li>
                        </div>  
                    </div>

                    <div class="externalStudentResult">
                        <div class="levels hnd1">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <h1 class="dept">HND 1</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="hndyearonefirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="hndyearonesecondsemester.php">Semester 2</a></li>
                        </div>
                         <div class="levels hnd2">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star second"></span>
                                    <h1 class="dept">HND 2</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="hndyeartwofirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="hndyeartwosecondsemester.php">Semester 2</a></li>
                        </div>  
                    </div>


                    <div class="ndResult">
                        <div class="levels nd1">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <h1 class="dept">ND 1</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="yearonefirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="yearonesecondsemester.php">Semester 2</a></li>
                        </div>

                        <div class="levels nd2">
                            <div class="iconDept">
                                <div class="text">
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star second"></span>
                                    <h1 class="dept">ND 2</h1>
                                    <span class="fa fa-caret"></span>
                                </div>
                            </div>
                            <li class="f"><a href="yeartwofirstsemester.php">Semester 1</a></li>
                            <li class="s"><a href="yeartwosecondsemester.php">Semester 2</a></li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logout">
                <h2>Logout</h2>
                <span class="fa fa-sign-out"></span>
            </div>
        </div>