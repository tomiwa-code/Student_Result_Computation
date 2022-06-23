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
            <!-- to show this add class 'nostudent'  -->
            <div class="detailsContainer secondSemes">
                <div class="info">
                    <img src="../img/sad-26.svg" alt="sadface">
                    <h1>No Student Found!</h1>
                    <p>The school is currently in <strong>FIRST SEMESTER</strong></p>
                </div>
            </div>
            <div class="detailContainer secondSemes">
                <div class="session hnd">
                    <h1 class="courseCode">Course Code: <span></span></h1>
                    <h1 class="courseUnit">Course Unit: <span></span></h1>
                    <h1 class="courseTitle">Course Title: <span></span></h1>
                    <h1>Level: HND 1</h1>
                    <h1><span class="semes"></span> Semester <span class="sexion"></span></h1>
                </div>
                <div class="updateInfo uhnd">
                    <div class="lInfo">
                        <h2 class="hnos">No. of students: <span></span></h2>
                        <h2 class="hstusubmit">Submitted: <span></span> </h2>
                        <h2 class="hstuactive">Active: <span></span></h2>
                    </div>
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
                        <!-- the table rows and colums goes here                  -->
                    </table>
                </div>
            </div>

            <div class="scoreStudent">
                <div class="scores">
                    <form action="#">
                        <div class="closeit">
                            <div class="close">
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                        <div class="stuMatric">
                            <p>Matric no</p>
                            <input class="input" type="text" name="smatric" readonly>
                        </div>
                        <div class="stuFullname">
                            <p>Full name</p>
                            <input class="input" type="text" name="sname" readonly>
                        </div>
                        <div class="sScore">
                            <p>Score</p>
                            <input class="input" type="text" name="score" autocomplete = "off">
                        </div>
                        <div class="submitScore">
                            <input type="submit" name="scoreSubmit" value="Submit">
                        </div>
                    </form>
                </div>
            </div>

            <div class="msgBoxBcg">
                <div class="msgBox">
                    <div class="msg">
                        <h3></h3>
                    </div>
                    <div class="btn">
                        <button>ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "../footer.php"?>
    <script src="../js/yearone.js"></script> 


    <script>
        $(document).ready(function () {
            $(".iconDept.dashboard").removeClass("active");
            $(".iconDept.dashboard .text").removeClass("active");
            $(".iconDept.dashboard .text li a").removeClass("active");
            $(".hnd1 .iconDept").addClass("active");
            $(".hnd1 .iconDept .text").addClass("active");
            $(".hnd1 .s a").addClass("active");

            $('.lecturerSideBar').animate({
                scrollTop: $('a[href="hndyearonesecondsemester.php"]').offset().top
            },1000)
        })
    </script>
</body>
</html>