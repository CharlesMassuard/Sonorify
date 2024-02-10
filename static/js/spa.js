import { addToPlaylist, playPlaylist , clearPlaylist, lireUneMusique } from './player.js';
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
document.querySelectorAll('#PlayMusique').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        fetch(element.href, {
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
            console.log(data);
            let info = JSON.parse(data);
            console.log(info['id_musique']);
            clearPlaylist();
            lireUneMusique(info['id_musique'], info['nomMusique'], info['cover'], info['nomGroupe'], info['nomAlbum'], info['urlMusique']);
        })
        .catch(error => console.error(error));  
        loadScripts(['spa.js', 'aside.js', 'playlist.js']);  
    }
    );
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
document.querySelectorAll('#PlayAlbum').forEach(form => {
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