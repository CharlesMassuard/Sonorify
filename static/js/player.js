import { loadFichier } from "./audioVisualizer.js";
import { playVisualize } from "./audioVisualizer.js";
import { init } from "./spa.js";

var sound;
var playlist = [
];

var playlistDetails = ["TheFatRat - Unity", "TheFatRat - Monody", "TheFatRat - Fly Away"];

var titlePage = document.querySelector('title');

var searchBar = document.getElementById('search');
var progressBar = document.getElementById('progressBar');
var progress = document.getElementById('progress');
var header = document.getElementById('trueHeader');

var player = document.getElementById('customPlayer');
var detailsSection = document.getElementById('detailsSection');
var playButton = document.getElementById('playButton');
var previousButton = document.getElementById('prevButton');
var nextButton = document.getElementById('nextButton');
var volumeButton = document.getElementById('volumeButton');
var repeatButton = document.getElementById('repeatButton');
var aleatoireButton = document.getElementById('shuffleButton');
var progressVolume = document.getElementById('progressVolume');
var sliderVolume = document.getElementById('volumeSlider');
var arrowUp = document.getElementById('arrowUp');
var visualizerButton = document.getElementById("visualizerButton");
var plusDetails = document.getElementById('moreMusic');
var optionsMusic = document.getElementById('optionsMusic');
var addMusiquePlaylist = document.getElementById('playlistButton');
var dialogPlaylist = document.getElementById('dialogPlaylist');
var buttonAddMusicToPlaylist = document.getElementById('addToPlaylist');
var musiquesASuivre = document.getElementById('musiquesASuivre');


var currentTime = document.getElementById('currentTime');
var circle_progress = document.getElementById('circle_progress');
var buttonIconPlay = document.querySelector('#playButton i.material-icons');
var volumeButtonI = document.querySelector('#volumeButton i.material-icons');
var repeatButtonI = document.querySelector('#repeatButton i.material-icons');
var aleatoireButtonI = document.querySelector('#shuffleButton i.material-icons');
var arrowUpI = document.querySelector('#arrowUp i.material-icons');
var visualizerButtonI = document.querySelector('#visualizerButton i.material-icons');

var inLecture = null;

var title = document.getElementById('title');
var cover = document.getElementById('cover');
var artiste = document.getElementById('nomArtiste');
var album = document.getElementById('nomAlbum');

//BIG PLAYER

var bigCover = document.getElementById('bigCover');

//

let timeoutId;
var in_play = false;
var isMute = false;
var currentVolume;
var currentTrackIndex = 0;
var repeat = 0;
var pause = false;
var currentTime;

export function lireUneMusique(id_musique, nom, cover, nomGroupe, nomAlbum, duree, url) {
    playlist = [];
    playlist.push(url);
    playlistDetails = [];
    playlistDetails.push([nom, cover, nomGroupe, nomAlbum, id_musique, duree]);
    addToListeLecture(id_musique, nom, cover, nomGroupe, nomAlbum, duree, url);
    playPlaylist();
};

export function addToPlaylist(id_musique, nom, cover, nomGroupe, nomAlbum, duree, url) {
    playlist.push(url);
    playlistDetails.push([nom, cover, nomGroupe, nomAlbum, id_musique, duree]);
    addToListeLecture(id_musique, nom, cover, nomGroupe, nomAlbum, duree, url);
};

export function addToListeLecture(id_musique, nom, cover, nomGroupe, nomAlbum, duree, url) {
    musiquesASuivre.innerHTML += "<li id='oneMusicListeLecture'>"+
    "<a href='jouerMusique.php?id="+id_musique+"' id=PlayMusiqueListeLecture>"+
        "<div class='flexContainerListeLecture'>" +
            "<div id='coverBigPlayer'>" +
                "<img class='imgListeLecture' src='../../ressources/images/"+cover+"' alt='cover'>" +
            "</div>" +
            "<div id='infoListeLecture'>" +
                "<h4 id='titleListe'>"+nom+"</h4>" +
                "<p id='artisteListe'>"+nomGroupe+" • "+nomAlbum+"</p>" +
                "<p id='dureeListe'>"+duree+"</p>" +
            "</div>" +
        "</div>" +
    "</a></li>";
    init();
}


function refreshListeLecture() {
    musiquesASuivre.innerHTML = "";
    for(let i = 0; i < playlistDetails.length; i++) {
        addToListeLecture(playlistDetails[i][4], playlistDetails[i][0], playlistDetails[i][1], playlistDetails[i][2], playlistDetails[i][3], playlist[i]);
    }
}

export function clearPlaylist() {
    musiquesASuivre.innerHTML = "";
    playlist = [];
    playlistDetails = [];
};

export function setFirstTrack(index) {
    currentTrackIndex = index;
};


export function playPlaylist() {
    if(player.style.display === 'none' || player.style.display === '') {
        player.style.display = 'flex';
    }
    // Fonction récursive pour jouer la playlist
    function playNextTrack() {
        // Libérer les ressources de la piste audio précédente
        if (sound) {
            sound.unload()
        }
        if (currentTrackIndex < playlist.length) {
            sound = new Howl({
                src: [playlist[currentTrackIndex]],
                format: ['mp3']
            });
            if(isMute){
                sound.volume(0);
            } else {
                sound.volume(sliderVolume.value);
            }
            // Définir l'événement onend seulement si sound est défini
            sound.on('end', function () {
                if(repeat != 2) {
                    currentTrackIndex++;
                    playNextTrack(); // Appeler la fonction pour jouer la piste suivante
                }
            });
            titlePage.textContent = playlistDetails[currentTrackIndex][0] + " - " + playlistDetails[currentTrackIndex][2];
            title.textContent = playlistDetails[currentTrackIndex][0];
            
            inLecture = playlistDetails[currentTrackIndex][0];
            cover.src = "../../ressources/images/"+playlistDetails[currentTrackIndex][1];
            bigCover.src = "../../ressources/images/"+playlistDetails[currentTrackIndex][1];
            artiste.textContent = playlistDetails[currentTrackIndex][2];
            album.textContent = playlistDetails[currentTrackIndex][3];
            play(true);
            sound.on('play', function () {
                setInterval(updateProgressBar, 100);
            });
        } else {
            if(repeat == 1) {
                currentTrackIndex = 0;
                playNextTrack();
            } else {
                currentTrackIndex = 0;
                play();
                in_play = false;
                pause = false;
                titlePage.textContent = "Sonorify";
            }
        }
    }
    

    // Commencer la lecture de la playlist
    playNextTrack();
}


var isUserTyping = false;

if (searchBar !== null) {
    searchBar.addEventListener('input', function () {
        isUserTyping = true;
    });

    searchBar.addEventListener('blur', function () {
        isUserTyping = false;
    });

    searchBar.addEventListener('mouseenter', function () {
        isUserTyping = true;
    });

    searchBar.addEventListener('mouseleave', function () {
        isUserTyping = false;
    });
}

// METTRE EN PAUSE AVEC SPACE BAR
document.addEventListener('keydown', function (event) {
    if (event.code === 'Space' && !isUserTyping) {
        event.preventDefault();
        if(in_play || pause) {
            play();
        } else {
            playPlaylist();
        }
    }
});

// Fonction de mise à jour de la barre de progression
function updateProgressBar() {
    var percentage = (sound.seek() / sound.duration()) * 100;
    progress.style.width = percentage + '%';

    circle_progress.style.left = (percentage-0.2) + '%';

    // Convertir le temps de lecture en format HH:MM:SS
    currentTime = formatTime(sound.seek());
    var totalTime = formatTime(sound.duration());

    currentTimeDisplay.textContent = currentTime + ' / ' + totalTime;
}

progressBar.addEventListener('mouseenter', function () {
    circle_progress.style.transition = 'opacity 0.3s ease';
    circle_progress.style.opacity = 1;
});

progressBar.addEventListener('mouseleave', function () {
    timeoutId = setTimeout(function () {
        circle_progress.style.transition = 'opacity 1s ease';
        circle_progress.style.opacity = 0;
    }, 1000);
});

progressBar.addEventListener('mouseenter', function () {
    clearTimeout(timeoutId);
});

// Fonction pour formater le temps en format HH:MM:SS
function formatTime(timeInSeconds) {
    var hours = Math.floor(timeInSeconds / 3600);
    var minutes = Math.floor((timeInSeconds % 3600) / 60);
    var seconds = Math.floor(timeInSeconds % 60);

    return pad(minutes) + ':' + pad(seconds);
}

// Fonction pour ajouter un zéro devant les nombres inférieurs à 10
function pad(number) {
    return (number < 10 ? '0' : '') + number;
}

function play(suite_playlist = false) {
    if(!suite_playlist) {
        if (!in_play && !pause) {
            sound.play();
            // loadFichier(sound);
            // playVisualize();
            in_play = true;
            buttonIconPlay.textContent = 'pause';
            buttonIconPlay.setAttribute('title', 'Pause');
        } else if(pause){
            pause = false;
            sound.play();
            in_play = true;
            buttonIconPlay.textContent = 'pause';
            buttonIconPlay.setAttribute('title', 'Pause');
        } else{
            pause = true;
            sound.pause();
            in_play = false;
            buttonIconPlay.textContent = 'play_arrow';
            buttonIconPlay.setAttribute('title', 'Lire');
        }
    } else {
        sound.play();
        // loadFichier(sound);
        // playVisualize();
        in_play = true;
        buttonIconPlay.textContent = 'pause';
        buttonIconPlay.setAttribute('title', 'Pause');
    }
}

// Événement pour lire la musique
playButton.addEventListener('click', function () {
    if(in_play || pause) {
        play();
    } else {
        playPlaylist();
    }
});

player.addEventListener('mouseleave', function () {
    progressVolume.style.opacity = 0;
});

repeatButton.addEventListener('click', function () {
    if (repeat == 0) {
        repeatButton.style.opacity = 1;
        repeatButtonI.textContent = 'repeat';
        repeatButton.setAttribute('title', 'Tout lire en boucle');
        repeat = 1;
    } else if (repeat == 1) {
        try{
            sound.loop(true);
            repeatButton.style.opacity = 1;
            repeatButtonI.textContent = 'repeat_one';
            repeatButton.setAttribute('title', 'Lire un titre en boucle');
            repeat = 2;
        } catch (e) {
            repeatButton.style.opacity = 0.5;
            repeatButtonI.textContent = 'repeat';
            repeatButton.setAttribute('title', 'Activer la répétition');
            repeat = 0;
        }
    } else {
        repeatButton.style.opacity = 0.5;
        repeatButtonI.textContent = 'repeat';
        repeatButton.setAttribute('title', 'Activer la répétition');
        sound.loop(false);
        repeat = 0;
    }
});

export function aleatoire() {
    for (let i = playlist.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [playlist[i], playlist[j]] = [playlist[j], playlist[i]];
        [playlistDetails[i], playlistDetails[j]] = [playlistDetails[j], playlistDetails[i]];
    }
    for(let i = 0; i < playlist.length; i++) {
        if(playlistDetails[i][0] == inLecture) {
            currentTrackIndex = i;
        }
    }
    refreshListeLecture();
}

aleatoireButton.addEventListener('click', function () {
    aleatoireButtonI.classList.toggle('rotate'); // Ajoute ou supprime la classe 'rotate'
    aleatoire();
});

arrowUp.addEventListener('click', function () {
    if (arrowUpI.classList.contains('rotate_arrow')) {
        arrowUp.style.opacity = 0.5;
    } else {
        arrowUp.style.opacity = 1;
    }
    arrowUpI.classList.toggle('rotate_arrow');
});

// Événement pour déplacer la lecture au clic sur la barre de progression
progressBar.addEventListener('click', function (e) {
    var rect = this.getBoundingClientRect();
    var clickPositionInPixels = e.clientX - rect.left;
    var clickPositionInPercentage = clickPositionInPixels / rect.width;
    sound.seek(sound.duration() * clickPositionInPercentage);
    updateProgressBar(); // Mettre à jour la barre de progression après le déplacement
});


var volumeButtonI = document.querySelector('#volumeButton i.material-icons');
var volumeButton = document.getElementById('volumeButton');

function toggleSection() {
    if (detailsSection.style.display === 'none' || detailsSection.style.display === '') {
        showDetailsSection();
    } else {
        hideDetailsSection();
    }
}

// Fonction pour afficher la section
function showDetailsSection() {
    detailsSection.style.transition = 'transform 0.3s ease';
    detailsSection.style.display = 'flex'; // Afficher la section
    header.style.borderBottom = '1px solid rgba(61, 61, 61, 0.8)';
    setTimeout(function () {
        detailsSection.style.transform = 'translateY(-100%)'; // Faire monter la section
    }, 10); // Ajouter un petit délai pour assurer que la transition est appliquée correctement
}

// Fonction pour masquer la section
function hideDetailsSection() {
    detailsSection.style.transition = 'transform 0.3s ease';
    detailsSection.style.transform = 'translateY(0)'; // Faire descendre la section
    setTimeout(function () {
        detailsSection.style.display = 'none'; // Masquer la section après la transition
    }, 300); // Attendre la fin de la transition avant de masquer la section
}

function changeVolume(volume){
    sound.volume(volume);
    if(volume == 0) {
        volumeButtonI.textContent = 'volume_mute';
    } else if (volume > 0 && volume < 0.5) {
        volumeButtonI.textContent = 'volume_down';
    } else {
        volumeButtonI.textContent = 'volume_up';
    }
}

volumeButton.addEventListener('mouseenter', function() {
    progressVolume.style.transition = 'opacity 0.4s ease';
    progressVolume.style.opacity = 1;
});

volumeButton.addEventListener('click', function() {
    if(!isMute) {
        isMute = true;
        currentVolume = sound.volume();
        sound.volume(0);
        volumeButtonI.textContent = 'volume_off';
        volumeButton.setAttribute('title', 'Activer le son');
    } else{
        isMute = false;
        changeVolume(currentVolume);
    }
});

sliderVolume.addEventListener('input', function () {
    changeVolume(sliderVolume.value);
});

sliderVolume.addEventListener('change', function () {
    changeVolume(sliderVolume.value);
});

arrowUp.addEventListener('click', function () {
    toggleSection();
});

visualizerButton.addEventListener('click', function () {
    window.location.href = "../../audioVisualizer.php";
});

previousButton.addEventListener('click', function () {
    if(currentTime <= "00:05"){
        pause = false;
        in_play = false;
        if(currentTrackIndex == 0) {
            currentTrackIndex = playlist.length - 1;
        } else {
            currentTrackIndex--;
        }
        playPlaylist();
    } else {
        sound.seek(0);
    }
});

nextButton.addEventListener('click', function () {
    pause = false;
    in_play = false;
    if(currentTrackIndex == playlist.length - 1) {
        currentTrackIndex = 0;
    } else {
        currentTrackIndex++;
    }
    playPlaylist();
});

moreMusic.addEventListener('click', function (event) {
    optionsMusic.style.display = 'flex';
    event.stopPropagation(); // Prevent this click from triggering the document click event below
});

document.addEventListener('click', function () {
    optionsMusic.style.display = 'none';
});

addMusiquePlaylist.addEventListener('click', function () {
    dialogPlaylist.style.display = 'block';
});

var idPlaylist;

$('#addToPlaylist').click(function() {
    idPlaylist = $(this).data('id-playlist');
    // Now you can use idPlaylist in your AJAX request
});

// buttonAddMusicToPlaylist.addEventListener('click', function () {
//     dialogPlaylist.style.display = 'none';
//     $.ajax({
//         url: '../../Classes/Data/DataBase.php', // the location of your PHP file
//         type: 'post', // the HTTP method you want to use
//         data: {
//             'function_name': 'insertMusiquePlaylist', // the name of the PHP function you want to call
//             'id_playlist': idPlaylist,
//             'id_musique': playlistDetails[currentTrackIndex][4], // any data you want to pass to the PHP function
//         },
//         success: function(response) {
//             // this function will be called when the AJAX request is successful
//             // 'response' will contain whatever the PHP function outputs
//             console.log(response);
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             // this function will be called if the AJAX request fails
//             console.log(textStatus, errorThrown);
//         }
//     });
// });


