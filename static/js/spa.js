import { addToPlaylist, playPlaylist , clearPlaylist, lireUneMusique, setFirstTrack } from './player.js';
const ids = ['Playlist', 'Accueil', 'Album', 'Genre', 'Groupe', 'ajout_note', 'Profil','Ajouter',"voirPlus","retourArriere"];

const clickHandler = (event) => {
    event.preventDefault();
    loadPage(event.currentTarget);
};
export function init() {
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

    document.querySelectorAll('#PlayGroupe').forEach(form => {
        form.removeEventListener('submit', playGroupeHandler);
        form.addEventListener('submit', playGroupeHandler);
    });

    document.querySelectorAll('#Favoris').forEach(form => {
        form.removeEventListener('submit', favorisHandler);
        form.addEventListener('submit', favorisHandler);
    });
  
    document.querySelectorAll('#ajouterMusiquePlaylist').forEach(form => {
        form.removeEventListener('submit', ajouterHandler);
        form.addEventListener('submit', ajouterHandler);
    } );

    document.querySelectorAll('#Supprimer').forEach(form => {
        form.removeEventListener('submit', supprimerHandler);
        form.addEventListener('submit', supprimerHandler);
    } );
  
    document.querySelectorAll('#changeTrack').forEach(element => {
        element.removeEventListener('click', changeTrackHandler);
        element.addEventListener('click', changeTrackHandler);
    });
}

const ajouterHandler = (event) => {
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

const supprimerHandler = (event) => {
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

const changeTrackHandler = (event) => {
    event.preventDefault();
    const element = event.currentTarget;
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
        playPlaylist();
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
    history.pushState({page: element.href}, '', element.href);
    fetch(element.href)
    .then(response => response.text())
    .then(data => {
        document.querySelector('main').innerHTML = data;
        let searchResult = document.querySelector("#search_result");
        searchResult.innerHTML = '';
        init()
        window.scrollTo(0, 0);
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

const playGroupeHandler = (event) => {
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

window.addEventListener('keydown', (event) => {
    if (event.key === 'F5') {
        event.preventDefault();
        loadPage(document.querySelector('#Accueil'));
        detailsSection.style.transition = 'transform 0.3s ease';
        detailsSection.style.transform = 'translateY(0)'; // Faire descendre la section
        setTimeout(function () {
            detailsSection.style.display = 'none'; // Masquer la section après la transition
        }, 300); // Attendre la fin de la transition avant de masquer la section
        if (arrowUpI.classList.contains('rotate_arrow')) {
            arrowUp.style.opacity = 0.5;
            arrowUpI.classList.toggle('rotate_arrow');
        }
    }
});

$(document).ready(function() {
    $(document).on('contextmenu', '.a_accueil', function(event) {
        event.preventDefault();
        $('#context-menu').css({
            top: event.pageY,
            left: event.pageX
        }).show();
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('#context-menu').length) {
            $('#context-menu').hide();
        }
    });
});
