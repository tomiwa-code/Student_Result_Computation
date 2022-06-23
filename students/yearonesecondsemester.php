<?php
    // load in the session file 
    include_once "../session.php";
    // load in the html header 
    include_once "../header.php";
?>

<body>
    <div class="main-Container">
        <?php include_once "sidebar.php"?>

        <div class="bodyDetail">
            <div class="rmsgContainer">
                <div class="rmsg">
                    <div class="successbell">
                        <span class="fa fa-bell"></span>
                    </div>
                    <div class="notymsg">
                        <p></p>
                    </div>
                    <div class="closenotyBtn">
                        <button><i class="fa fa-times"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="detailContainer stud">
                <div class="dresult">
                    <div class="session y1"> 
                        <h1 class="numero">Name: <span></span></h1>
                        <h1 class="mat">Matric No: <span></span></h1>
                        <h1 class="secs">Semester: <span></span></h1>
                        <h1 class="se">Session: <span></span></h1>
                    </div>

                    <button id="second" class="schoolSemester"></button>
                    <input class="stulevel" type="text" value="1" readonly hidden>

                    <div class="fail">
                        
                        <table>
                            
                        </table>
                    </div>

                    <div class="result tbly1">
                        <table>
                            <!-- rows and columns goes in here  -->
                        </table>
                    </div>

                    <div class="resultstatus">
                        <div class="currenttotalunit">
                            Current Total Unit: <span></span>
                        </div>
                        <div class="gpa">
                            GPA: <span></span>
                        </div>
                        <div class="currentgpa">
                            Current GPA: <span></span>
                        </div>
                    </div>
                </div>

                <div class="outergradesystem">
                    <div class="printResult">
                        <button>
                            Print Result
                        </button>
                    </div>
                    <div class="gradesystem">
                        <div class="gd"><h1>Grade System</h1></div>
                        <table>
                            <tr>
                                <td>70 - 100%</td>
                                <td>3.50 - 4.00</td>
                                <td>Distinction</td>
                            </tr>
                            <tr>
                                <td>60 - 69.99%</td>
                                <td>3.00 - 3.49</td>
                                <td>Upper Credit</td>
                            </tr>
                            <tr>
                                <td>50 - 59.99%</td>
                                <td>2.50 - 2.99</td>
                                <td>Lower</td>
                            </tr>
                            <tr>
                                <td>40 - 49.99%</td>
                                <td>2.00 - 2.49</td>
                                <td>Pass</td>
                            </tr>
                            <tr>
                                <td>00 - 39.99%</td>
                                <td>0.00 - 1.99</td>
                                <td>Fail</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "../footer.php"?>
    <script src="../js/studentResult.js"></script>
    <script src="../js/notify.js"></script>


    <script>
        $(document).ready(function () {
            $(".iconDept.dashboard").removeClass("active");
            $(".iconDept.dashboard .text").removeClass("active");
            $(".iconDept.dashboard .text li a").removeClass("active");
            $(".nd1 .iconDept").addClass("active");
            $(".nd1 .text").addClass("active");
            $(".nd1 .s a").addClass("active"); 

            $('.studentSideBar').animate({
                scrollTop: $('a[href="studentgui.php"]').offset().top
            },1000)
        })
    </script>
</body>
</html>