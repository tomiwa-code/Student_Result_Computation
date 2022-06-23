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
            <div class="mainDetailsContainer">
                <div class="mapDetails">
                    <img src="../img/mapoly-logo.png" alt="mapoly-logo">
                    <h1>Welcome</h1>
                    <h2><?php echo $rows['lastname']." ".$rows['firstname']." ". $rows['middlename'] ?></h2>
                    <p><?php echo $rows['matric_no']?></p>
                </div>
                <div class="desc">
                    <p>Moshood Abiola Polytechnic graciously welcomes you, <?php echo $rows['firstname']?> to regularly use this uncommon tool in conformity to our desire to be a world-class institution producing the best-breed of pupils of international repute and global champions of tomorrow. Deployments of up-to-now technologies amongst other investments give us the superior edge above other schools. Moshood Abiola Polytechnic is now accessible to you anywhere, anytime, 24/7/366.<br><br>From here, you can view your results of all Sessions and Terms while in school.Please use the navigation links to your left to perform neccessary action.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "../footer.php"?> 
    <script src="../js/notify.js"></script>
</body>
</html>