<?php 
    // load in the session file 
    include_once "../session.php";
    // load in the dbs for session
    include_once "loadDB.php";
    // load in the html header 
    include_once "../header.php";
?>
<body>
    <div class="main-Containers">
        <?php include_once "sidebar.php" ?>

        <div class="bodySettings">
            <div class="detailContainer">
               <div class="setrecord">
                   <div class="csession">
                        <h3>Current Session: </h3>
                        <input type="text" placeholder="2019/2020">
                    </div>

                    <div class="csemester">
                        <h3>Current Semester: </h3>
                        <select>
                            <option value="first">First Semester</option>
                            <option value="second">Second Semester</option>
                        </select>
                    </div>
                    <button class="setSession"> Set Session</button>
               </div>
            </div>
        </div>
    </div>

    <?php include_once "../footer.php"?>
    

    <script>
        $(document).ready(function () {
            $(".iconDept.dashboard").removeClass("active");
            $(".iconDept.dashboard .text").removeClass("active");
            $(".iconDept.dashboard .text li a").removeClass("active");
            $(".iconDept.adj").addClass("active");
            $(".iconDept.adj .text").addClass("active");
            $(".iconDept.adj .text li a").addClass("active");

            // if the set session button was clicked 
            $(".setSession").click(function () {
                // get the input and the session value 
                let sVal = $(".csession input").val();
                let seVal = $(".csemester select").val();  
                // send it to php file 
                $.post("../php/setsession.php", {
                    session : sVal,
                    semester : seVal
                }, function (data) {
                    if (data == "Session and semester is set successfully!") {
                        // session set succesfully notification 
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr["success"](data);
                        
                        setTimeout(() => {
                            location.href = "superadmingui.php";
                        }, 3000);   

                        $(".setSession").css('pointer-events', 'none');
                    } else
                    if (data == "Session, semester and year is set successfully!") {
                        // session set succesfully notification 
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "3000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr["success"](data);
                        
                        setTimeout(() => {
                            location.href = "superadmingui.php";
                        }, 3000);   

                        $(".setSession").css('pointer-events', 'none');
                    }
                })
            })

            $('.lecturerSideBar').animate({
                scrollTop: $('a[href="settings.php"]').offset().top
            },1000)
        })
    </script>
</body>
</html>