var buttonActiverAside = document.getElementById("menu__toggle");
var aside = document.querySelector("aside");
var main = document.querySelector("main");
var header = document.getElementById("trueHeader");
var logo = document.getElementById("logo");
var details = document.getElementById("detailsSection");
var hamburgerButton = document.getElementById("hamburger");
var menuItems = document.querySelectorAll(".menu__item");
var isActived = false;
var accueil = document.getElementById("Accueil");
var profil = document.getElementById("Profil");
var bibliotheque = document.getElementById("bibliotheque");
var detailsSection = document.getElementById("detailsSection");
var arrowUp = document.querySelector('#arrowUp');
var arrowUpI = document.querySelector('#arrowUp i.material-icons');

buttonActiverAside.addEventListener("click", function() {

    aside.style.transition = "width 0.3s";
    header.style.transition = "margin-left 0.3s";
    main.style.transition = "margin-left 0.3s";
    details.style.transition = "margin-left 0.3s";
    logo.style.transition = "opacity 0.3s";
    hamburgerButton.style.transition = "left 0.3s";
    for(var i = 0; i < menuItems.length; i++) {
        menuItems[i].style.transition = "margin-left 0.3s";
    }
    if(isActived) {
        aside.style.width = "100px";
        main.style.marginLeft = "100px";
        header.style.marginLeft = "100px";
        details.style.marginLeft = "101px";
        logo.style.opacity = "0";
        hamburgerButton.style.left = "35px";
        for(var i = 0; i < menuItems.length; i++) {
            menuItems[i].style.marginLeft = "-35px";    
        }
        isActived = false;
    } else {
        aside.style.width = "200px";
        main.style.marginLeft = "200px";
        header.style.marginLeft = "200px";
        details.style.marginLeft = "201px";
        hamburgerButton.style.left = "20px";
        logo.style.opacity = "1";
        for(var i = 0; i < menuItems.length; i++) {
            menuItems[i].style.marginLeft = "-45px";
        }
        isActived = true;
    }
});

accueil.addEventListener("click", function() {
    detailsSection.style.transition = 'transform 0.3s ease';
    detailsSection.style.transform = 'translateY(0)'; // Faire descendre la section
    setTimeout(function () {
        detailsSection.style.display = 'none'; // Masquer la section après la transition
    }, 300); // Attendre la fin de la transition avant de masquer la section
    if (arrowUpI.classList.contains('rotate_arrow')) {
        arrowUp.style.opacity = 0.5;
        arrowUpI.classList.toggle('rotate_arrow');
        arrowUp.setAttribute('title', 'Afficher les détails');
    }
});

profil.addEventListener("click", function() {
    detailsSection.style.transition = 'transform 0.3s ease';
    detailsSection.style.transform = 'translateY(0)'; // Faire descendre la section
    setTimeout(function () {
        detailsSection.style.display = 'none'; // Masquer la section après la transition
    }, 300); // Attendre la fin de la transition avant de masquer la section
    if (arrowUpI.classList.contains('rotate_arrow')) {
        arrowUp.style.opacity = 0.5;
        arrowUpI.classList.toggle('rotate_arrow');
        arrowUp.setAttribute('title', 'Afficher les détails');
    }
});

bibliotheque.addEventListener("click", function() {
    detailsSection.style.transition = 'transform 0.3s ease';
    detailsSection.style.transform = 'translateY(0)'; // Faire descendre la section
    setTimeout(function () {
        detailsSection.style.display = 'none'; // Masquer la section après la transition
    }, 300); // Attendre la fin de la transition avant de masquer la section
    if (arrowUpI.classList.contains('rotate_arrow')) {
        arrowUp.style.opacity = 0.5;
        arrowUpI.classList.toggle('rotate_arrow');
        arrowUp.setAttribute('title', 'Afficher les détails');
    }
});
