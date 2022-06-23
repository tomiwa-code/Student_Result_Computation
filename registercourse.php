<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/main.css">
    <link rel="stylesheet" href="dist/css/font-face.css">
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <link rel="shortcut icon" href="img/mapoly-logo.jpg">
    <link rel="stylesheet" href="dist/css/toastr.min.css">
    <title>Studend Result Compilation</title>
    <script src="vend/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="mainContainers">
        <div class="coreRegContainer">
            <div class="cheader">
                <p>Course Registration</p>
            </div>
            <div class="coreReg">
                <div class="cInput">
                    <p>Matric No.</p>
                    <input type="text" placeholder="15/69/0006">
                </div>
                <div class="cBtn">
                    <button>Submit</button>
                </div>
            </div>

            <div class="coreList">
                <div class="sems">
                    <p><span></span> Semester</p>
                    <p class="sexion"></p>
                </div>
                <table>
                    
                </table>
                <div class="sBtn">
                    <button>Register course</button>
                    <p>go back</p>
                </div>
            </div>

            <div class="errMsg">
                <div class="sMsg">
                    <p></p>
                </div>
            </div>



        </div>
    </div>

    <script src="js/toastr.min.js"></script>
    <script src="js/coursereg.js"></script>
</body>
</html>