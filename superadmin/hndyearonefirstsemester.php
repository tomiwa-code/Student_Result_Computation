<?php 
    // load in the session file 
    include_once "../session.php";
    // load in the html header 
    include_once "../header.php";
?>
<body>
    <div class="main-Containers">
        <?php include_once "sidebar.php" ?>

        <div class="bodyDetails">
            <!-- if second semester is on  -->
            <div class="detailsContainer firstSemes">
                <div class="info">
                    <img src="../img/sad-26.svg" alt="sadface">
                    <h1>No Student Found!</h1>
                    <p>The school is currently in <strong>SECOND SEMESTER</strong></p>
                </div>
            </div>
            <!-- if lecturer is done with work  -->
            <div class="detailsContainer congratf">
                <div class="info">
                    <img src="../img/clap.png" alt="clap">
                    <h1>Congratulations!</h1>
                    <p>Weldone scoring is complete</p>
                </div>
            </div>

            <div class="detailContainer firstSemes">
                <div class="superadmin">
                    <div class="session">
                        <h1>Level: HND 1</h1>
                        <h1>Semester: <?php echo $seRows['current_semester'] ?> Semester <?php echo $seRows['session'] ?></h1>
                    </div>
                    <div class="changeSession">
                        <h3>Change Session:</h3>
                        <div class="year">
                            <select name="years"> <?php ?>
                                <?php
                                    $sql = "SELECT * FROM `tblsessiony` ORDER BY id DESC";
                                    $query = mysqli_query($conn, $sql);
                                    
                                    if (mysqli_num_rows($query) > 0) {
                                        while ($rows = mysqli_fetch_assoc($query)) {
                                            $sexion = $rows['session'];
                                            ?>
                                            <option value="<?php echo $sexion ?>"><?php echo $sexion ?></option>;
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                            <button>Change</button>
                        </div>
                    </div>
                </div>
                
                <div class="updateInfo superadmin">
                    <div class="search">
                        <div class="searchbox">
                            <span>Search for students base on the provided column names</span>
                            <input type="text" name="search" placeholder="Search for students" autocomplete="off">
                        </div>
                        <button class="searchBtn"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <div class="scoringTable tblhnd">
                    <table>
                        <!-- rows and columns goes in here  -->
                    </table>
                </div>

                <div class="uResult">
                    <div class="cResult">
                        <div class="result">
                            <div class="closeBtn">
                                <button><i class="fa fa-times"></i></button>
                            </div>
                            <div class="errorText">
                                <!-- text goes in here  -->
                            </div>
                            <table>
                                <!-- table goes in here  -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

    <?php include_once "../footer.php"?>
    <script src="../js/superadmin.js"></script>

    <script>
        $(document).ready(function () {
            $(".iconDept.dashboard").removeClass("active");
            $(".iconDept.dashboard .text").removeClass("active");
            $(".iconDept.dashboard .text li a").removeClass("active");
            $(".hnd1 .iconDept").addClass("active");
            $(".hnd1 .text").addClass("active");
            $(".hnd1 .f a").addClass("active"); 

            $('.lecturerSideBar').animate({
                scrollTop: $('a[href="hndyearonefirstsemester.php"]').offset().top
            },1000)
        })
    </script>
</body>
</html>