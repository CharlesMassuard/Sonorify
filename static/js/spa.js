import { addToPlaylist, playPlaylist , clearPlaylist } from './player.js';
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
        return loadScripts(['spa.js', 'aside.js', 'playlist.js']);     
    })
    .catch(error => {
        console.log(error);
    });
}

function loadScripts(scripts) {
    let promises = scripts.map(script => import('/static/js/' + script + '?t=' + Date.now()));
    return Promise.all(promises)
}
document.querySelectorAll('#PlayPlaylist').forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        clearPlaylist();
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
        loadScripts(['spa.js', 'aside.js', 'playlist.js']);  
    }); 
} );
console.log('playlist.js');