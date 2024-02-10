document.querySelectorAll('#Playlist').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
} );
document.querySelectorAll('#Accueil').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
});
document.querySelectorAll('#Album').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
});
document.querySelectorAll('#ajout_note').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
} );
document.querySelectorAll('#Profil').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
} );

function loadPage(element) {
    fetch(element.href)
    .then(response => response.text())
    .then(data => {
        document.querySelector('main').innerHTML = data;
        // history.pushState({page: element.href}, '', element.href);
        loadScripts(['spa.js', 'aside.js', 'playlist.js']);     
    })
    .catch(error => {
        console.log(error);
    });
}

function loadScripts(scripts) {
    let main = document.querySelector('main');
    scripts.forEach(src => {
        const script = document.createElement('script');
        script.src = "./static/js/"+src;
        main.appendChild(script);
    });
}
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page
    console.log(event.target);
    // Récupère les données du formulaire
    var formData = new FormData(event.target);
    console.log(formData);
    // Envoie les données du formulaire à votre serveur
    fetch('submit_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Met à jour la page avec les données retournées par le serveur
        document.querySelector('main').innerHTML = data;
    })
    .catch(error => {
        console.log(error);
    });
});