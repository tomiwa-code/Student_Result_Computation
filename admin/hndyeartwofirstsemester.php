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
                <div class="session admin">
                    <h1>Level: HND 2</h1>
                    <h1>Semester: <?php echo $seRows['current_semester']?> Semester <?php echo $seRows['session']?></h1>
                </div>
                <div class="updateInfo">
                    <div class="lInfo">
                        <h2 class="hunos">Marks Submitted: <span></span></h2>
                        <h2 class="hustusubmit">Uploaded: <span></span></h2>
                        <h2 class="hustuactive">Active: <span></span></h2>
                    </div>
                    <div class="search">
                        <div class="searchbox">
                            <span>Search for students base on the provided column names</span>
                            <input type="text" name="search" placeholder="Search for students" autocomplete="off">
                        </div>
                        <button class="searchBtn"><i class="fa fa-search"></i></button>
                    </div>
                </div>

                <div class="scoringTable tblhnd2">
                    <button class="calcGp"></button>
                    <table>
                        <!-- table goes in here  -->
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "../footer.php"?>
    <script src="../js/adminSemester.js"></script>

    <script>
        $(document).ready(function () {
            $(".iconDept.dashboard").removeClass("active");
            $(".iconDept.dashboard .text").removeClass("active");
            $(".iconDept.dashboard .text li a").removeClass("active");
            $(".hnd2 .iconDept").addClass("active");
            $(".hnd2 .text").addClass("active");
            $(".hnd2 .f a").addClass("active"); 

            $('.lecturerSideBar').animate({
                scrollTop: $('a[href="hndyeartwofirstsemester.php"]').offset().top
            },1000)
        })
    </script>
</body>
</html>