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
            <div class="mainDetailsContainer">
                <div class="mapDetails">
                    <img src="../img/mapoly-logo.jpg" alt="mapoly-logo">
                    <h1>Welcome</h1>
                    <h2><?php echo $rowsIV['lastname']." ".$rowsIV['firstname']." ". $rowsIV['middlename'] ?></h2>
                    <p><?php echo $rowsIV['level']?></p>
                </div>
                <div class="desc">
                <p>Moshood Abiola Polytechnic graciously welcomes you, <?php echo $rowsIV['firstname'] ?> to regularly use this uncommon tool in conformity to our desire to be a world-class institution producing the best-breed of pupils of international repute and global champions of tomorrow. Deployments of up-to-now technologies amongst other investments give us the superior edge above other schools. Moshood Abiola Polytechnic is now accessible to you anywhere, anytime, 24/7/366.
                    <br><br>
                    From here, you can set your student score for all Sessions and levels.Please use the navigation links to your left to perform neccessary action. </p>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "../footer.php"?>
</body>
</html>