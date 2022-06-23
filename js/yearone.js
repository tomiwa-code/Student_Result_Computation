$(document).ready(function () {

    // get the course supervised by the lecturer
    $.get('../php/loadDB.php', function(data) {
        const hold = data.split('_')
        const eHold = hold[0].split(',')
        const gHold = hold[2].split(',')

        if (eHold[5] == 'nd') {
            $(".nd .courseCode span").text(eHold[0]);
            $(".nd .courseUnit span").text(eHold[1]);
            $(".nd .courseTitle span").text(eHold[2]);
            $(".nd .semes").text(eHold[3]);
            $(".nd .sexion").text(eHold[4]);
        } else {
            $('.nd').text('no courses supervised by this lecturer found')
        }

        if (gHold[5] == 'hnd') {
            $(".hnd .courseCode span").text(gHold[0]);
            $(".hnd .courseUnit span").text(gHold[1]);
            $(".hnd .courseTitle span").text(gHold[2]);
            $(".hnd .semes").text(gHold[3]);
            $(".hnd .sexion").text(gHold[4]);
        } else {
            $('.hnd').text('no courses supervised by this lecturer found')
        }
    })
    
    // get lecturer work details 
    setInterval(() => {
        $.get("../php/lecturerworkdetails.php", function (data) {
            const hold = data.split("_");
            const ln = hold[0].split(',') 
            const hln = hold[2].split(',') 

            if (ln[3] == 'nd') {
                $(".nos span").text(ln[0]);
                $(".stusubmit span").text(ln[1]);
                $(".stuactive span").text(ln[2]);
            } else {
                $('.und').text('No student registered yet')
            }

            if (hln[3] == 'hnd') {
                $(".hnos span").text(hln[0]);
                $(".hstusubmit span").text(hln[1]);
                $(".hstuactive span").text(hln[2]);
            } else {
                $('.uhnd').text('No student registered yet')
            }
        })
    }, 500);
    
    // search icon clicked  
    $(".searchBtn").click(function () {
        $(this).toggleClass("active");
        $("i").toggleClass("active");
        $(".searchbox input").val("");
        $(".searchbox input").fadeToggle(300);
        $(".searchbox input").focus();
    });

    // get the value of searchInput on typing 
    $(".searchbox input").keyup(function () {
        // get the value of the input search 
        let holdSearch = $(this).val();
        // // send the value to php file 
        $.post("../php/search.php",{
            searchInput : holdSearch
        }, function (data) {
            let sep = data.split('-');
                // for nd 
                if (sep[1] == 'nd') {
                    $(".scoringTable.tblnd table").html(`<tr>
                    <th>S/No</th>
                    <th>Matric No</th>
                    <th>Full Name</th>
                    <th>Program</th>
                    <th></th>
                    </tr>
                ${sep[0]}`);
                }
                // for hnd 
                if (sep[3] == 'hnd') {
                    $(".scoringTable.tblhnd table").html(`<tr>
                    <th>S/No</th>
                    <th>Matric No</th>
                    <th>Full Name</th>
                    <th>Program</th>
                    <th></th>
                    </tr>
                ${sep[2]}`);
                }
        })
    })

    // students table update
    setInterval(() => {
        $.get("../php/students.php", function (data) {
            // if the user is not currently searching 
            if (!$(".searchBtn").hasClass("active")) {
                let sep = data.split('-');
                // for nd 
                if (sep[1] == 'nd') {
                    $(".scoringTable.tblnd table").html(`<tr>
                    <th>S/No</th>
                    <th>Matric No</th>
                    <th>Full Name</th>
                    <th>Program</th>
                    <th></th>
                    </tr>
                ${sep[0]}`);
                }
                // for hnd 
                if (sep[3] == 'hnd') {
                    $(".scoringTable.tblhnd table").html(`<tr>
                    <th>S/No</th>
                    <th>Matric No</th>
                    <th>Full Name</th>
                    <th>Program</th>
                    <th></th>
                    </tr>
                ${sep[2]}`);
                }
            }
        })
    }, 500)

    // score submit close button 
    $(".closeit .close").click(function () {
        $(".scoreStudent").fadeOut();
        $(".sScore input").val('');
        $(".lecturerSideBar").removeClass("notClicked");
        $(".sScore input").removeClass("error");
    })

    // student score submssion 
    $(".scoreStudent form").submit(function (e) {
        e.preventDefault();

        $.post("../php/stuscoring.php", {
            matric_no :  $(".stuMatric input").val(),
            stuScore : $(".sScore input").val(),
            courseId : $(".takeCare input").val()
        }, function (data) {
            if (data == 'Score cannot be empty') {
                $(".lecturerSideBar").addClass("notClicked");
                $(".msgBoxBcg").fadeIn();
                $(".msgBoxBcg .msg h3").text(data);
                $(".sScore input").addClass("error");
            } else {
                if (data == 'Score can only be number') {
                    $(".lecturerSideBar").addClass("notClicked");
                    $(".msgBoxBcg").fadeIn();
                    $(".msgBoxBcg .msg h3").text(data);
                    $(".sScore input").addClass("error");
                } else {
                    if (data == 'Score cannot be greater than 100') {
                        $(".lecturerSideBar").addClass("notClicked");
                        $(".msgBoxBcg").fadeIn();
                        $(".msgBoxBcg .msg h3").text(data);
                        $(".sScore input").addClass("error");
                    } else {
                        $(".scoreStudent").fadeOut();
                        $(".sScore input").val("");
                        $(".lecturerSideBar").removeClass("notClicked");
                        // Submit mark succesfully notification 
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
                        toastr["success"](`Mark ${data} !`);
                    }
                }
            }
        })
    })

    // student score submssion error close button 
    $(".msgBoxBcg .btn").click( function() {
        $(".lecturerSideBar").removeClass("notClicked");
        $(".msgBoxBcg").fadeOut(); 
        $(".sScore input").focus();
    });

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
})

// each submit score button 
function test(hold) {
    let stuMatric = hold.getAttribute('id');
    $(".scoreStudent").fadeIn();
    $(".lecturerSideBar").addClass("notClicked");
    $(".sScore input").focus();

    // get the student name and matric number 
    $.post("../php/stufullname.php",{
        params : stuMatric,
    }, function (data) {
        let newData = data.split('-');
        $(".stuMatric input").val(newData[1]);
        $(".stuFullname input").val(newData[0]);
    }) 
}

