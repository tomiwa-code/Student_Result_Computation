$(document).ready(function () {
    // get the current semester of the school session 
    setInterval(() => {
        $.get("../php/endSemes.php", function (data) {
            if (data == 'first semester is on') {
                $(".detailContainer.firstSemes").fadeIn();
                $(".detailsContainer.secondSemes").fadeIn();
                $(".detailContainer.secondSemes").fadeOut();
                $(".detailsContainer.firstSemes").fadeOut();
            } else {
                if (data == 'second semester is on') {
                    $(".detailContainer.secondSemes").fadeIn();
                    $(".detailsContainer.firstSemes").fadeIn();
                    $(".detailContainer.firstSemes").fadeOut();
                    $(".detailsContainer.secondSemes").fadeOut();  
                }
            }
        })
    }, 500);   

    // admin work done update 
    setInterval(()=> {
        $.get("../php/adminworkdetails.php", function (data) {
            let hold = data.split('-');            
            if (hold[1] = 'nd') {
                let ln = hold[0].split(' ');
                $(".nos span").text(ln[0]);
                $(".stusubmit span").text(ln[1]);
                $(".stuactive span").text(ln[2]);
            }
            if (hold[3] = 'hnd') {
                let ln = hold[2].split(' ');
                $(".hnos span").text(ln[0]);
                $(".hstusubmit span").text(ln[1]);
                $(".hstuactive span").text(ln[2]);
            }
            if (hold[5] = 'nd2') {
                let ln = hold[4].split(' ');
                $(".unos span").text(ln[0]);
                $(".ustusubmit span").text(ln[1]);
                $(".ustuactive span").text(ln[2]);
            }
            if (hold[7] = 'hnd2') {
                let ln = hold[6].split(' ');
                $(".hunos span").text(ln[0]);
                $(".hustusubmit span").text(ln[1]);
                $(".hustuactive span").text(ln[2]);
            }
        });
    }, 500);

    // when the search button is clicked  
    $(".searchBtn").click(function () {
        $(this).toggleClass("active");
        $("i").toggleClass("active");
        $(".searchbox input").val("");
        $(".searchbox input").fadeToggle(300);
        $(".searchbox input").focus();
    });

    // students table update 
    function holdd(a,n,p) {
        return $(`.scoringTable.${p} table`).html(`<tr>
        <th>S/No</th>
        <th>Matric No</th>
        <th>Full Name</th>
        <th>Program</th>
        <th>Course Code</th>
        <th>Score</th>
        <th></th>
        </tr>
        ${a[n]}`);
    }
    setInterval(()=> {
        $.get("../php/adminsemester.php", function (data) {
            if (!$(".searchBtn").hasClass("active")) {
                let hold = data.split('_');
                if (hold[1] == 'nd') {
                    holdd(hold, 0, 'tblnd');
                }
                if (hold[3] == 'hnd') {
                    holdd(hold,2, 'tblhnd');
                }
                if (hold[5] == 'nd2') {
                    holdd(hold, 4, 'tblnd2');
                }
                if (hold[7] == 'hnd2') {
                    holdd(hold, 6, 'tblhnd2');
                }
            }
        }) 
    }, 500);

    // get the value of the input search 
    $(".searchbox input").keyup(function () {
        let holdSearch = $(this).val();
        // // send the value to php file 
        $.post("../php/adminsearch.php",{
            searchInput : holdSearch
        }, function (data) {
            let hold = data.split('_');
            if (hold[1] == 'nd') {
                holdd(hold, 0, 'tblnd');
            }
            if (hold[3] == 'hnd') {
                holdd(hold,2, 'tblhnd');
            }
            if (hold[5] == 'nd2') {
                holdd(hold, 4, 'tblnd2');
            }
            if (hold[7] == 'hnd2') {
                holdd(hold, 6, 'tblhnd2');
            }
        })
    });
})

// when the upload bitton is clicked 
function test(hold) {
    // get the hidden matric_num and courseId in the button make an array of them and split 
    let holdArry = hold.getAttribute('id').split("-");
    // the matric Number 
    const stuMatric = holdArry[0];
    // the mark score by the student
    const courseId = holdArry[1];

    // create an array of grading system 
    const stuMark = ['F','E', 'DE', 'D', 'CD', 'C', 'BC', 'B', 'AB', 'A'];
    // create an array of credit point grading 
    const stuCp = [0.00, 2.00, 2.25, 2.50, 2.75, 3.00, 3.25, 3.50, 3.75, 4.00];

    // function to check if a student mark is within range 
    function between(x, min, max) {
        return ((x - min ) * (x - max) <= 0);
    }

    // sending the matric num and course id to php  
    $.post("../php/getstumark.php", {
        matNo : stuMatric,
        stuCourse : courseId
    }, function (data) {
        // split the mark and course unit coming from php 
        let newData = data.split(' ');

        // declaring student current course unit and mark scored
        let stuMarks = newData[0];
        let courseUnit = newData[1];

        // declaring student current course grade and credit point
        let grade = '';
        let creditPoint;

        // if the student score between 0-39 
        if (between(stuMarks,0,39)) {
            grade = stuMark[0];
            creditPoint = courseUnit * stuCp[0];
        } 
        // if the student score between 40-44
        else if (between(stuMarks,40,44)) {
            grade = stuMark[1];
            creditPoint = courseUnit * stuCp[1];
        } 
        // if the student score between 45-49
        else if (between(stuMarks,45,49)) {
            grade = stuMark[2];
            creditPoint = courseUnit * stuCp[2];
        } 
        // if the student score between 50-54
        else if (between(stuMarks,50,54)) {
            grade = stuMark[3];
            creditPoint = courseUnit * stuCp[3];
        } 
        // if the student score between 55-59
        else if (between(stuMarks,55,59)) {
            grade = stuMark[4];
            creditPoint = courseUnit * stuCp[4];
        }
        // if the student score between 60-64
        else if (between(stuMarks,60,64)) {
            grade = stuMark[5];
            creditPoint = courseUnit * stuCp[5];
        }
        // if the student score between 65-69
        else if (between(stuMarks,65,69)) {
            grade = stuMark[6];
            creditPoint = courseUnit * stuCp[6];
        }
        // if the student score between 70-74
        else if (between(stuMarks,70,74)) {
            grade = stuMark[7];
            creditPoint = courseUnit * stuCp[7];
        }
        // if the student score between 75-79
        else if (between(stuMarks,75,79)) {
            grade = stuMark[8];
            creditPoint = courseUnit * stuCp[8];
        }
        // if the student score between 80-100
        else if (between(stuMarks,80,100)) {
            grade = stuMark[9];
            creditPoint = courseUnit * stuCp[9];
        }
        else {
            alert("An error occured, That's all we know");
        }

        // send the current student grade and credit unit to db 
        $.post("../php/gradecreditpoint.php", {
            matric_no : stuMatric,
            course_Id : courseId,
            stuGrade : grade,
            stuCreditPoint : creditPoint
        }, function (data) { 
                let cData = data.split('-');
                let mc = cData[0];
                let rslt = cData[1];

                if (rslt == "Result uploaded succesfully!") {
                    // Result uploaded succesfully notification or not
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "700",
                        "timeOut": "3000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                        }
                        toastr["success"](`${mc} ${rslt}`);
                    $(".calcGp").trigger("click");
                }
            });

            $(".calcGp").click(function () {
                // get the student result from php using jQuery 
                $.post("../php/calcgpa.php", {
                    matric_no : stuMatric,
                    courseId : courseId
                },function (data) {
                    console.log(data); 
                })
            })
    })
}
