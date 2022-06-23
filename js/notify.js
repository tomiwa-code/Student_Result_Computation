$(document).ready(function () {

    // notify student about new result 
    setInterval(()=> {
        $.get("../php/notifystu.php", function (data) {
            if (data == "New result has been added") {
                $(".rmsgContainer").fadeIn(300);
                $(".notymsg p").text(data);
                // animate bell ntification
                $(".successbell span").toggleClass("active");
                console.log(data);
            } else {
                $(".rmsgContainer").hide();
            }
        })
    }, 1000);


    // hide the notification 
    $(".rmsgContainer").click(function () {
        $.get("../php/clearnoty.php", function (data) {
            if (data == "notification seen") {
                $(".rmsgContainer").hide();
            }
        });
    });

    // trigger the hide button 
    setTimeout(() => {
        $(".rmsgContainer").trigger("click")
    }, 5000);

    // get the level of the student 
    $.get("../php/getUser.php", function (data) {
        if (data == 'Na Nd student') {
            $(".ndResult").fadeIn();
        } else {
            if (data == "na Old Student") {  
                $(".oldStudentResult").fadeIn();
                $(".logout").css('position', 'relative');
            } else {
                if (data == 'na Foriegn Key') {
                    $(".externalStudentResult").fadeIn()
                }
            }
        }
    })


})