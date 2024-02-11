import { addToPlaylist, playPlaylist , clearPlaylist, lireUneMusique, setFirstTrack } from './player.js';
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
document.querySelectorAll('#Genre').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
} );
document.querySelectorAll('#Groupe').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        loadPage(element);
    });
} );
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
        clearPlaylist();
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
            let info = JSON.parse(data);
            clearPlaylist();
            lireUneMusique(info['id_musique'], info['nom_musique'], info['cover'], info['nom_groupe'], info['nom_album'], info['urlMusique']);
        })
        .catch(error => console.error(error));  
    }
    );
} );
document.querySelectorAll('#PlayPlaylistMusique').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        clearPlaylist();
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
            data = JSON.parse(data);
            setFirstTrack(data['firstTrack']);
            for (let info of data['musiques']){
                addToPlaylist(info['id_musique'], info['nom_musique'], info['cover'], info['nom_groupe'], info['nom_album'], info['urlMusique']);
            }
            playPlaylist();
        })
        .catch(error => console.error(error));  
    }
    );
} );
document.querySelectorAll('#PlayAlbumMusique').forEach(element => {
    element.addEventListener('click', (event) => {
        event.preventDefault();
        clearPlaylist();
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
            data = JSON.parse(data);
            setFirstTrack(data['firstTrack']);
            for (let info of data['musiques']){
                addToPlaylist(info['id_musique'], info['nom_musique'], info['cover'], info['nom_groupe'], info['nom_album'], info['urlMusique']);
            }
            playPlaylist();
        }
        )
        .catch(error => console.error(error));
    }
    );
} );

function loadPage(element) {
    window.scrollTo(0, 0);
    fetch(element.href)
    .then(response => response.text())
    .then(data => {
        document.querySelector('main').innerHTML = data;
        let searchResult = document.querySelector("#search_result");
        searchResult.innerHTML = '';
        // history.pushState({page: element.href}, '', element.href);
        return loadScripts(['spa.js', 'aside.js', 'playlist.js']);     
    })
    .catch(error => {
        console.log(error);
    });
}

export function loadScripts(scripts) {
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
            data = JSON.parse(data);
            setFirstTrack(0);
            for (let info of data["musiques"]){
                addToPlaylist(info['id_musique'], info['nom_musique'], info['cover'], info['nom_groupe'], info['nom_album'], info['urlMusique']);
            }
            playPlaylist();
        })
        .catch(error => console.error(error));  
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
            data = JSON.parse(data);
            setFirstTrack(0);
            for (let info of data['musiques']){
                addToPlaylist(info['id_musique'], info['nom_musique'], info['cover'], info['nom_groupe'], info['nom_album'], info['urlMusique']);
            }
            playPlaylist();
        })
        .catch(error => console.error(error));  
    }); 
} );