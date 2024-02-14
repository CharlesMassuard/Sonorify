import { addToPlaylist, playPlaylist , clearPlaylist, lireUneMusique, setFirstTrack } from './player.js';
import { deleteVisualizer } from './audioVisualizer.js';
const ids = ['Playlist', 'Accueil', 'Album', 'Genre', 'Groupe', 'ajout_note', 'Profil', 'audioVisualizer', 'changeTrack'];

const clickHandler = (event) => {
    event.preventDefault();
    loadPage(event.currentTarget);
};
export function init() {
    deleteVisualizer();
    ids.forEach(id => {
        const elements = document.querySelectorAll(`#${id}`);
        elements.forEach(element => {
            element.removeEventListener('click', clickHandler);
            element.addEventListener('click', clickHandler);
        });
    });

    document.querySelectorAll('#PlayMusique').forEach(element => {
        element.removeEventListener('click', playMusicHandler);
        element.addEventListener('click', playMusicHandler);
    });

    document.querySelectorAll('#PlayPlaylistMusique').forEach(element => {
        element.removeEventListener('click', playPlaylistMusicHandler);
        element.addEventListener('click', playPlaylistMusicHandler);
    });

    document.querySelectorAll('#PlayAlbumMusique').forEach(element => {
        element.removeEventListener('click', playAlbumMusicHandler);
        element.addEventListener('click', playAlbumMusicHandler);
    });

    document.querySelectorAll('#PlayPlaylist').forEach(form => {
        form.removeEventListener('submit', playPlaylistHandler);
        form.addEventListener('submit', playPlaylistHandler);
    });

    document.querySelectorAll('#PlayAlbum').forEach(form => {
        form.removeEventListener('submit', playAlbumHandler);
        form.addEventListener('submit', playAlbumHandler);
    });

    document.querySelectorAll('#Favoris').forEach(form => {
        form.removeEventListener('submit', favorisHandler);
        form.addEventListener('submit', favorisHandler);
    });

    document.querySelectorAll('#changeTrack').forEach(element => {
        element.removeEventListener('click', changeTrackHandler);
        element.addEventListener('click', changeTrackHandler);
    });
}

const changeTrackHandler = (event) => {
    event.preventDefault();
    const element = event.currentTarget;
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
        setFirstTrack(info['index']);
    })
    .catch(error => console.error(error));  
    }

const playMusicHandler = (event) => {
    event.preventDefault();
    const element = event.currentTarget;
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
        let searchResult = document.querySelector("#search_result");
        searchResult.innerHTML = '';
    })
    .catch(error => console.error(error));  
    }

const playPlaylistMusicHandler = (event) => {
    event.preventDefault();
    const element = event.currentTarget;
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

const playAlbumMusicHandler = (event) => {
    event.preventDefault();
    const element = event.currentTarget;
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
        init()
        return loadScripts(['playlist.js']); 
    })
    .catch(error => {
        console.log(error);
    });
}

export function loadScripts(scripts) {
    let promises = scripts.map(script => import('/static/js/' + script + '?t=' + Date.now()));
    return Promise.all(promises)
}
const playPlaylistHandler = (event) => {
    event.preventDefault();
    const form = event.currentTarget;
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
}
const playAlbumHandler = (event) => {
    event.preventDefault();
    const form = event.currentTarget;
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
};

const favorisHandler = (event) => {
    event.preventDefault();
    const form = event.target;
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
        init()
        return loadScripts(['playlist.js']); 
        }
    })
    .catch(error => {
        console.log(error);
    });
}

window.addEventListener('DOMContentLoaded', init);

document.addEventListener('fullscreenchange', function() {
    if (!document.fullscreenElement) {
        let aside = document.querySelector('aside');
        let header = document.getElementById('trueHeader');
        aside.style.display = 'flex';
        header.style.display = 'block';
    }
});