import { addToPlaylist, playPlaylist , clearPlaylist, lireUneMusique, setFirstTrack } from './player.js';
const ids = ['Playlist', 'Accueil', 'Album', 'Genre', 'Groupe', 'ajout_note', 'Profil'];

const clickHandler = (event) => {
    event.preventDefault();
    loadPage(event.currentTarget);
};

ids.forEach(id => {
    const elements = document.querySelectorAll(`#${id}`);
    elements.forEach(element => {
        element.removeEventListener('click', clickHandler);
        element.addEventListener('click', clickHandler);
    });
});
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

window.addEventListener('popstate', (event) => {
    loadPage(document.querySelector('#Accueil'));
});

function loadPage(element) {
    window.scrollTo(0, 0);
    history.pushState({page: element.href}, '', element.href);
    fetch(element.href)
    .then(response => response.text())
    .then(data => {
        document.querySelector('main').innerHTML = data;
        let searchResult = document.querySelector("#search_result");
        searchResult.innerHTML = '';
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

document.querySelectorAll('#Favoris').forEach(form => {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        let action = event.target.action;

        let formData = new FormData(event.target);

        fetch(action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data) {
                document.querySelector('main').innerHTML = data;
                let searchResult = document.querySelector("#search_result");
                searchResult.innerHTML = '';
                return loadScripts(['spa.js', 'aside.js', 'playlist.js']);   
            }
        })
        .catch(error => {
            console.log(error);
        });
    });
});