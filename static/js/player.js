// Sélection des éléments HTML
var sound = new Howl({
    src: ["https://od.lk/s/ODFfNzcxMzg3MDFf/38%20Finale.mp3"] // utilisation de l'hebergeur Opendrive.com
});

var searchBar = document.getElementById('search');
var progressBar = document.getElementById('progressBar');
var progress = document.getElementById('progress');

var player = document.getElementById('customPlayer');
var playButton = document.getElementById('playButton');
var previousButton = document.getElementById('prevButton');
var nextButton = document.getElementById('nextButton');
var volumeButton = document.getElementById('volumeButton');
var repeatButton = document.getElementById('repeatButton');
var aleatoireButton = document.getElementById('shuffleButton');
var progressVolume = document.getElementById('progressVolume');
var sliderVolume = document.getElementById('sliderVolume');

var currentTime = document.getElementById('currentTime');
var circle_progress = document.getElementById('circle_progress');
var buttonIconPlay = document.querySelector('#playButton i.material-icons');
var volumeButtonI = document.querySelector('#volumeButton i.material-icons');
var repeatButtonI = document.querySelector('#repeatButton i.material-icons');
var aleatoireButtonI = document.querySelector('#shuffleButton i.material-icons');
let timeoutId;
var in_play = false;
var isMute = false;
var currentVolume;



// METTRE EN PAUSE AVEC SPACE BAR
isUserTyping = false;

searchBar.addEventListener('input', function() {
    isUserTyping = true;
});

searchBar.addEventListener('blur', function() {
    isUserTyping = false;
});

searchBar.addEventListener('mouseenter', function() {
    isUserTyping = true;
});

searchBar.addEventListener('mouseleave', function() {
    isUserTyping = false;
});

document.addEventListener('keydown', function(event) {
    if (event.code === 'Space' && !isUserTyping){
        event.preventDefault();
        play();
    }
});
//////////////////////////////////////////////////////
// Fonction de mise à jour de la barre de progression
function updateProgressBar() {
    var percentage = (sound.seek() / sound.duration()) * 100;
    progress.style.width = percentage + '%';

    circle_progress.style.left = (percentage-0.2) + '%';
    
    // Convertir le temps de lecture en format HH:MM:SS
    var currentTime = formatTime(sound.seek());
    var totalTime = formatTime(sound.duration());
    
    currentTimeDisplay.textContent = currentTime + ' / ' + totalTime;

    if(currentTime == totalTime) {
        if(!sound.loop()) {
            in_play = false;
            buttonIconPlay.textContent = 'play_arrow';
        }
    }
}

progressBar.addEventListener('mouseenter', function() {
    circle_progress.style.transition = 'opacity 0.3s ease';
    circle_progress.style.opacity = 1;
});

progressBar.addEventListener('mouseleave', function() {
    timeoutId = setTimeout(function() {
        circle_progress.style.transition = 'opacity 1s ease';
        circle_progress.style.opacity = 0;
    }, 1000);
});

progressBar.addEventListener('mouseenter', function() {
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

function play() {
    if(!in_play) {
        sound.play();
        in_play = true;
        buttonIconPlay.textContent = 'pause';
        buttonIconPlay.setAttribute('title', 'Pause');
    } else {
        sound.pause();
        in_play = false;
        buttonIconPlay.textContent = 'play_arrow';
        buttonIconPlay.setAttribute('title', 'Lire');
    }
}

// Événement pour lire la musique
playButton.addEventListener('click', function () {
    play();
});

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

player.addEventListener('mouseleave', function() {
    progressVolume.style.opacity = 0;
});


repeatButton.addEventListener('click', function() {
    if(sound.loop()) {
        sound.loop(false);
        repeatButton.style.opacity = 0.5;
        repeatButtonI.textContent = 'repeat';
        repeatButton.setAttribute('title', 'Activer la répétition');
    } else {
        sound.loop(true);
        repeatButton.style.opacity = 1;
        repeatButtonI.textContent = 'repeat_one';
        repeatButton.setAttribute('title', 'Désactiver la répétition');
    }
});

aleatoireButton.addEventListener('click', function() {
    aleatoireButtonI.classList.toggle('rotate'); // Ajoute ou supprime la classe 'rotate'
});

// Événement pour mettre à jour la barre de progression
sound.on('play', function() {
    setInterval(updateProgressBar, 100);
});

// Événement pour déplacer la lecture au clic sur la barre de progression
progressBar.addEventListener('click', function(e) {
    var rect = this.getBoundingClientRect();
    var clickPositionInPixels = e.clientX - rect.left;
    var clickPositionInPercentage = clickPositionInPixels / rect.width;
    sound.seek(sound.duration() * clickPositionInPercentage);
    updateProgressBar(); // Mettre à jour la barre de progression après le déplacement
});

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
