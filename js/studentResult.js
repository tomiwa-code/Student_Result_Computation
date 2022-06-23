$(document).ready(function () {
    $(".stud").fadeIn(500);

    // student details and result info 
    $(".schoolSemester").click(function () {
        let stulvl = $(".stulevel").val();
        let semes = $(this).attr('id');

        $.post("../php/getStudent.php", {
            stulvl : stulvl,
            semes : semes
        }, function (data) {
            let dSplit = data.split('_');
            $(".session.y1 .se span").text(dSplit[1]);
            $(".session.y1 .numero span").text(dSplit[0]);
            $(".session.y1 .mat span").text(dSplit[2]);
            $(".session.y1 .secs span").text(dSplit[3]);
        })

    })

    // student result 
    $(".schoolSemester").click(function () {
        let stulvl = $(".stulevel").val();
        let semes = $(this).attr('id');
        $.post("../php/studentResult.php", {
            stulvl : stulvl,
            semes : semes
        }, function (data) {
            $(".result.tbly1 table").html(`<tr>
                    <th>S/No</th>
                    <th>Course Title</th>
                    <th>Course Code</th>
                    <th>Course Units</th>
                    <th>Course Type</th>
                    <th>Credit Point</th>
                    <th>Grade</th>
                </tr>
            ${data}`);
        })
    })

    $(".schoolSemester").click(function () {
        let stulvl = $(".stulevel").val();
        let semes = $(this).attr('id');
        $.post("../php/studentGpa.php", {
            stulvl : stulvl,
            semes : semes
        }, function (data) {
            let holdData = data.split('-');
            let gpa = holdData[0];
            let cgpa = holdData[1]
            let courseUnit = holdData[2];
            $(".gpa span").text(gpa);
            $(".currentgpa span").text(cgpa);
            $(".currenttotalunit span").text(courseUnit)
        })
    })
    
    // check if the student fail 
    $(".schoolSemester").click(function () {
        let stulvl = $(".stulevel").val();
        let semes = $(this).attr('id');
        $.post("../php/fail.php", {
            stulvl : stulvl,
            semes : semes
        }, function (data) {
            let fc = data.split('-');
            let fTable = fc[0];
            let msg = fc[1];
            if (msg == "failed") {
                $(".fail").show();
                $(".fail table").html(fTable);
            }
        })
    })

    $(".schoolSemester").trigger('click');

    
    // when the student click print button 
    $(".printResult button").click(function () {
        window.print();
    });
    
})










