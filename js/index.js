const form = document.querySelector("form"),
signInBtn = document.querySelector("input[type='submit'"),
pError = document.querySelector(".pass p"),
eError = document.querySelector(".email p"),
emailError = document.querySelector(".email input"),
passError = document.querySelector(".pass input");

// prevent defailt submission 
form.onsubmit = (e) => {
    e.preventDefault()
}

// when the sigin button is clicked 
signInBtn.onclick = () => {
    
    // working with xml document
        // create a XMLHttpRequest object  
        let xhr = new XMLHttpRequest();
        // open the file location 
        xhr.open("POST", "php/index.php", true);
        // Object on load 
        xhr.onload = () => {
            if (xhr.status == 200) { // if the connection is ok
                let data = xhr.responseText;
                if (data == "student") {
                    location.href = "./students/studentgui.php";
                } else {
                    if (data == "lecturer") {
                        location.href = "./lecturer/lecturergui.php";
                    } else {
                        if (data == "admin") {
                            location.href = "./admin/admingui.php";
                        } else {
                            if (data == "superadmin") {
                                location.href = "./superadmin/superadmingui.php";
                            } else {
                                if (data == "Incorrect Email") {
                                    eError.style.display = "block";
                                    eError.innerHTML = data;
                                    emailError.classList.add("error");
                                    pError.innerHTML = "";
                                    passError.classList.remove("error");
                                } else  {
                                    if (data == "Incorrect Password") {
                                        pError.style.display = "block";
                                        pError.innerHTML = data;
                                        passError.classList.add("error");
                                        eError.innerHTML = "";
                                        emailError.classList.remove("error");
                                    } else {
                                        if (data == "Email is not valid") {
                                            pError.style.display = "block";
                                            pError.innerHTML = data;
                                            emailError.classList.add("error");
                                        } else {
                                            pError.style.display = "block";
                                            pError.innerHTML = data;
                                            emailError.classList.remove("error");
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                
            }
        }
        let sForm = new FormData(form);
        xhr.send(sForm);
}

