import { loadFichier } from "./audioVisualizer.js";
import { playVisualize } from "./audioVisualizer.js";

var sound;
var playlist = [
    "https://audio.jukehost.co.uk/2BNwH5heGwPsQ3lOHhMfgBA9Pm5mAxow",
    "https://audio.jukehost.co.uk/RJZlOinQcXyxi48c9eKKmiZavmIdQhqi",
    "https://audio.jukehost.co.uk/RfYql1AahtejVIK4vl8iRLZ4SSln3huB",
];

var playlistDetails = [];

var titlePage = document.querySelector('title');

var searchBar = document.getElementById('search');
var progressBar = document.getElementById('progressBar');
var progress = document.getElementById('progress');
var header = document.getElementById('trueHeader');

var player = document.getElementById('customPlayer');
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

var currentTime = document.getElementById('currentTime');
var circle_progress = document.getElementById('circle_progress');
var buttonIconPlay = document.querySelector('#playButton i.material-icons');
var volumeButtonI = document.querySelector('#volumeButton i.material-icons');
var repeatButtonI = document.querySelector('#repeatButton i.material-icons');
var aleatoireButtonI = document.querySelector('#shuffleButton i.material-icons');
var arrowUpI = document.querySelector('#arrowUp i.material-icons');
var visualizerButtonI = document.querySelector('#visualizerButton i.material-icons');

var title = document.getElementById('title');
var cover = document.getElementById('cover');
var artiste = document.getElementById('nomArtiste');
var album = document.getElementById('nomAlbum');

let timeoutId;
var in_play = false;
var isMute = false;
var currentVolume;
var currentTrackIndex = 0;
var repeat = 0;
var pause = false;
var currentTime;

export function lireUneMusique(nom, cover, nomGroupe, nomAlbum, url) {
    playlist = [];
    playlist.push(url);
    playlistDetails = [];
    playlistDetails.push([nom, cover, nomGroupe, nomAlbum]);
}

export function playPlaylist() {

    console.log('playPlaylist');

    // Fonction récursive pour jouer la playlist
    function playNextTrack() {
        // Libérer les ressources de la piste audio précédente
        if (sound) {
            sound.unload();
        }
        if (currentTrackIndex < playlist.length) {
            sound = new Howl({
                src: [playlist[currentTrackIndex]],
                format: ['mp3']
            });
            // Définir l'événement onend seulement si sound est défini
            sound.on('end', function () {
                if(repeat != 2) {
                    currentTrackIndex++;
                    playNextTrack(); // Appeler la fonction pour jouer la piste suivante
                }
            });
            titlePage.textContent = playlistDetails[currentTrackIndex][0] + " - " + playlistDetails[currentTrackIndex][2];
            title.textContent = playlistDetails[currentTrackIndex][0];
            
            cover.src = "../../ressources/images/"+playlistDetails[currentTrackIndex][1];
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
            loadFichier(sound);
            playVisualize();
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
        loadFichier(sound);
        playVisualize();
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

aleatoireButton.addEventListener('click', function () {
    aleatoireButtonI.classList.toggle('rotate'); // Ajoute ou supprime la classe 'rotate'
    var currentMusic = playlist[currentTrackIndex];
    do{
        playlist.sort(function () {
            return 0.5 - Math.random();
        });
    } while(playlist[0] != currentMusic);
    currentTrackIndex = 0;
    console.log(playlist);
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
    var section = document.getElementById('detailsSection');
    if (section.style.display === 'none' || section.style.display === '') {
        showDetailsSection();
    } else {
        hideDetailsSection();
    }
}

// Fonction pour afficher la section
function showDetailsSection() {
    var detailsSection = document.getElementById('detailsSection');
    detailsSection.style.transition = 'transform 0.3s ease';
    detailsSection.style.display = 'block'; // Afficher la section
    header.style.borderBottom = '1px solid rgba(61, 61, 61, 0.8)';
    setTimeout(function () {
        detailsSection.style.transform = 'translateY(-100%)'; // Faire monter la section
    }, 10); // Ajouter un petit délai pour assurer que la transition est appliquée correctement
}

// Fonction pour masquer la section
function hideDetailsSection() {
    var detailsSection = document.getElementById('detailsSection');
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