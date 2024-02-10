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
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', (event) => {
        console.log('submit');
        event.preventDefault();
        let formData = new FormData(form);
        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector('main').innerHTML = data;
            loadScripts(['spa.js', 'aside.js', 'playlist.js']);
        })
        .catch(error => {
            console.log(error);
        });
    });
} );
console.log(document.querySelectorAll('form'));