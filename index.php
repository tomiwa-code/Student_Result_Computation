<!-- 
    designed by ogunbase ayoola adetomiwa 15/69/0006 
    with a friend who helped with research and some code
    @2022 all work done for now
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist/css/main.css">
    <link rel="stylesheet" href="dist/css/font-face.css">
    <link rel="stylesheet" href="dist/css/flickity.min.css">
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <link rel="shortcut icon" href="img/mapoly-logo.jpg">
    <script src="vendors/jquery-3.6.0.min.js"></script>
    <title>Student Result Compilation</title>
</head>
<body>
    
    <div class="main-Container">

        <div class="container">
            <div class="signImg md-6 main-caro">
                <div class="caro1" data-flickity-bg-lazyload="image.jpg">
                    <div class="quotesContainer">
                        <div class="quotes">
                            <h3>Education is the passport to the future, for tommorow belongs to those who prepare for it today.</h3>
                        </div>
                        <div class="quoteBy">
                            <p>- Malcolm X</p>
                        </div>
                    </div>
                </div>
                <div class="caro2" data-flickity-bg-lazyload="image.jpg">
                    <div class="quotesContainer">
                        <div class="quotes">
                            <h3>Education is what remains after one has forgotten what one has learned in school.
                            </h3>
                        </div>
                        <div class="quoteBy">
                            <p>- Albert Einstein</p>
                        </div>
                    </div>
                </div>
                <div class="caro3" data-flickity-bg-lazyload="image.jpg">
                    <div class="quotesContainer">
                        <div class="quotes">
                            <h3>The learning process continues until the day you die.</h3>
                        </div>
                        <div class="quoteBy">
                            <p>- Kirk Douglas</p>
                        </div>
                    </div>
                </div>
                <div class="caro4" data-flickity-bg-lazyload="image.jpg">
                    <div class="quotesContainer">
                        <div class="quotes">
                            <h3>An investment in knowledge pays the best inerest.</h3>
                        </div>
                        <div class="quoteBy">
                            <p>- Benjamin Franklin</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="signIn md-6 ">
                <div class="siginIn-Form">
                    <div class="img">
                        <img src="img/mapoly-logo.png" alt="mapoly_logo">
                    </div>

                    <div class="text">
                        <p>Welcome back! please login back to your account</p>
                    </div>
                    

                    <form action="#">
                        <div class="email input">
                            <label for="email">Email</label>
                            <input type="text" name="email" required>
                            <p></p>
                        </div>
                        <div class="pass input">
                            <label for="password">Password</label>
                            <input type="password" name="pass" required>
                            <i class="fa fa-eye"></i>
                            <p></p>
                        </div>
                        <div class="fpass">
                            <a href="forgotpassword.html">Forgot Password?</a>
                        </div>
                        <div class="login">
                            <input type="submit" name="signin" value="Sign In">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <script src="vend/flickity.pkgd.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/index.js"></script>
</body>
</html>