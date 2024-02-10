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
        script.type = "module";
        main.appendChild(script);
    });
}
import { addToPlaylist } from './player.js';
import { playPlaylist } from './player.js';
document.querySelectorAll('#PlayPlaylist').forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'data=' + encodeURIComponent(event.target.value),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur HTTP, statut = " + response.status);
            }
            return response.text();
        })
        .then(data => {
            for (let info of JSON.parse(data)){
                addToPlaylist(info['id_musique'], info['nomMusique'], info['cover'], info['nomGroupe'], info['nomAlbum'], info['urlMusique']);
            }
            playPlaylist();
        })
        .catch(error => console.error(error));
    });
} );