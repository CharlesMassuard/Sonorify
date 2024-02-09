var buttonActiverAside = document.getElementById("menu__toggle");
var aside = document.querySelector("aside");
var main = document.querySelector("main");
var logo = document.getElementById("logo");
var details = document.getElementById("detailsSection");
var hamburgerButton = document.getElementById("hamburger");
var menuItems = document.querySelectorAll(".menu__item");
var musiques = document.getElementById("playlistAlbum");
var isActived = false;

buttonActiverAside.addEventListener("click", function() {

    aside.style.transition = "width 0.3s";
    main.style.transition = "margin-left 0.3s";
    details.style.transition = "margin-left 0.3s";
    logo.style.transition = "opacity 0.3s";
    hamburgerButton.style.transition = "left 0.3s";
    musiques.style.transition = "margin-left 0.3s";
    for(var i = 0; i < menuItems.length; i++) {
        menuItems[i].style.transition = "margin-left 0.3s";
    }
    if(isActived) {
        aside.style.width = "100px";
        main.style.marginLeft = "100px";
        details.style.marginLeft = "101px";
        logo.style.opacity = "0";
        hamburgerButton.style.left = "35px";
        musiques.style.marginLeft = "100px";
        for(var i = 0; i < menuItems.length; i++) {
            menuItems[i].style.marginLeft = "-35px";
        }
        isActived = false;
    } else {
        aside.style.width = "200px";
        main.style.marginLeft = "200px";
        details.style.marginLeft = "201px";
        hamburgerButton.style.left = "20px";
        musiques.style.marginLeft = "45px";
        logo.style.opacity = "1";
        for(var i = 0; i < menuItems.length; i++) {
            menuItems[i].style.marginLeft = "-45px";
        }
        isActived = true;
    }
});