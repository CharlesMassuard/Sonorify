var buttonActiverAside = document.getElementById("menu__toggle");
var aside = document.querySelector("aside");
var main = document.querySelector("main");
var logo = document.getElementById("logo");
var details = document.getElementById("detailsSection");
var isActived = false;

buttonActiverAside.addEventListener("click", function() {
    aside.style.transition = "width 0.3s";
    main.style.transition = "margin-left 0.3s";
    details.style.transition = "margin-left 0.3s";
    logo.style.transition = "opacity 0.3s";
    if(isActived) {
        aside.style.width = "100px";
        main.style.marginLeft = "100px";
        details.style.marginLeft = "101px";
        logo.style.opacity = "0";
        isActived = false;
    } else {
        aside.style.width = "200px";
        main.style.marginLeft = "200px";
        details.style.marginLeft = "201px";
        logo.style.opacity = "1";
        isActived = true;
    }
});