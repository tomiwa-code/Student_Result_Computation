const logoutBtn = document.querySelector(".logout span");

logoutBtn.onclick = () => {
    
    // create XMLHttpRequest object 
    let xhr = new XMLHttpRequest();
    // open the php file 
    xhr.open("POST", "../php/logout.php");
    // the page when on load 
    xhr.onload = () => {
        if (xhr.status == 200) {
            let data = xhr.responseText;
            if (data == "LogoutSuccess"){
                location.href = "../index.php";
            }
        }
    }
    xhr.send();
}