$(document).ready(function () {

    // submit matric number 
    $(".cBtn button").click(function () {
        let matNo = $(".cInput input").val();
        $.post("php/regcourse.php", {
            matNo : matNo
        }, function (data) {
            let scat = data.split('-');
            let oData = scat[0];
            let ses = scat[1];
            let sess = scat[2];
            $(".coreList table").html(oData);
            $(".sems p span").text(ses);
            $(".sexion").text(sess);
            $(".coreReg").hide();
            $(".coreList").show();
        })
    })

    // register course button 
    let chkboxes = [];

    $(".sBtn button").click(function () {
        let matNo = $(".cInput input").val();
        $("td input:checked").each(function () {
            chkboxes.push($(this).val());
        })
        $.post("php/courseReg.php", {
            chkboxes,
            matNo : matNo
        }, function (data) {
            $(".coreList").hide();
            $(".errMsg").show();
            $(".sMsg p").text(data);

            setTimeout(() => {
                location.href = "registercourse.php";
            }, 5000);

        })
    })
        
    // go back button 
    $(".sBtn p").click(function () {
        $(".coreList").hide();
        $(".coreReg").show();
    })

})