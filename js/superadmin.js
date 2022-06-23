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

    // when the search button is clicked  
    $(".searchBtn").click(function () {
        $(this).toggleClass("active");
        $("i").toggleClass("active");
        $(".searchbox input").val("");
        $(".searchbox input").fadeToggle(300);
        $(".searchbox input").focus();
    }); 

    // get the value of searchInput on typing 
    $(".searchbox input").keyup(function () {
        // get the year the superadmin is viewing 
        let sexion = $(".year select").val();
        // get the value of the input search 
        let holdSearch = $(this).val();
        // send the value to php file 
        $.post("../php/superadminsearch.php",{
            searchInput : holdSearch,
            sexion : sexion
        }, function (data) {
            let dSplit = data.split('-');
            if (dSplit[1] == 'nd') {
                saTable(dSplit, 0, 'tblnd')
            }
            if (dSplit[3] == 'hnd') {
                saTable(dSplit, 2, 'tblhnd')
            }
            if (dSplit[5] == 'nd2') {
                saTable(dSplit, 4, 'tblnd2')
            }
            if (dSplit[7] == 'hnd2') {
                saTable(dSplit, 6, 'tblhnd2')
            }
        })
    });

    function saTable(arry,num, tbl) {
        return $(`.scoringTable.${tbl} table`).html(`<tr>
        <th>S/No</th>
        <th>Matric No</th>
        <th>Full Name</th>
        <th>Gpa</th>
        <th>Cgpa</th>
        <th></th>
        </tr>
        ${arry[num]}`);
    }

    $(".year button").click( function () {
        let sexion = $(".year select").val();
        $.post("../php/superadmincheckresult.php", {
            sexion : sexion
        },function (data) {  
            let dSplit = data.split('_');
            if (!$(".searchBtn").hasClass("active")) {
                if (dSplit[1] == 'nd') {
                    saTable(dSplit, 0, 'tblnd')
                }
                if (dSplit[3] == 'hnd') {
                    saTable(dSplit, 2, 'tblhnd')
                }
                if (dSplit[5] == 'nd2') {
                    saTable(dSplit, 4, 'tblnd2')
                }
                if (dSplit[7] == 'hnd2') {
                    saTable(dSplit, 6, 'tblhnd2')
                }
            }
        })
    })
    setInterval(() => {
        $(".year button").trigger('click');
    }, 500);
    

    // when the close button is clicked 
    $(".closeBtn button").click(function () {
        $(".uResult").fadeOut();
        $(".lecturerSideBar").css("pointer-events","auto");
        $(".errorText").hide();
        $(".result table").show(800);
    })
});

// when the user click view result 
function vResult(tStudent) {
    $(".uResult").fadeIn();
    $(".lecturerSideBar").css("pointer-events","none");
    let stuId = tStudent.getAttribute('id');
    let sexion = $(".year select").val();

    $.post("../php/superadminview.php", {
        stuMat : stuId,
        sexion : sexion
    }, function (data) {
        if (data == '') {
            $(".errorText").show();
            $(".errorText").text("no result found at the moment.");
            $(".result table").hide();
        }
        $(".result table").html(`<tr>
                <th>S/No</th>
                <th>Matric No</th>
                <th>Course Title</th>
                <th>Course Code</th>
                <th>Course Units</th>
                <th>Course Type</th>
                <th>Credit Point</th>
                <th>Grade</th>
                <th></th>
            </tr>
        ${data}`) 
    })
}

// when the user click allow edit 
function aEdit (courseId) {
    let cm = courseId.getAttribute("id").split('-');
    let cId = cm[0];
    let matNo = cm[1];
    let sexion = $(".year select").val();
    $.post("../php/superadminallow.php", {
        cId : cId,
        matNo : matNo,
        sexion : sexion
    }, function (data) {
        $(courseId).addClass("active");
        $(courseId).text(data);
    });
}

