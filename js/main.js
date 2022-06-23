"use strict";

// slideshow for sign in 
let slideShow = document.querySelector('.main-caro');
let flkty = new Flickity( slideShow, {
  // options
    autoPlay: true,
    fade: true,
    wrapAround: true,
    prevNextButtons: false,
    pageDots: false,
    bgLazyLoad: true
});

// when sigin is intereacted with
const eFocus = document.querySelector(".email input"),
eLabel = document.querySelector(".email label"),
pLabel = document.querySelector(".pass label"),
pFocus = document.querySelector(".pass input");

eFocus.onfocus= () => {
  if (eFocus.value == "") {
    eLabel.classList.add("slideUp");
  }
}

eFocus.addEventListener("focusout", () => {
  if (eFocus.value == "") {
    eLabel.classList.remove("slideUp");
  }
});

pFocus.onfocus= () => {
  if (pFocus.value == "") {
    pLabel.classList.add("slideUp");
  }
}

pFocus.addEventListener("focusout", () => {
  if (pFocus.value == "") {
    pLabel.classList.remove("slideUp");
  }
});

// show and hide password 
const eye = document.querySelector(".input i");

eye.onclick = () => {
  if (pFocus.getAttribute("type") === "password") {
    pFocus.setAttribute("type", "text");
    eye.classList.add("active");
  } else {
    pFocus.setAttribute("type", "password");
    eye.classList.remove("active");
  }
}


 