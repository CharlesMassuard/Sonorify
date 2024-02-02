// Sélection des éléments HTML
var sound = new Howl({
    src: ["https://od.lk/s/ODFfNzcxMzg3MDFf/38%20Finale.mp3"] // utilisation de l'hebergeur Opendrive.com
});

var searchBar = document.getElementById('search');
var progressBar = document.getElementById('progressBar');
var progress = document.getElementById('progress');

var playButton = document.getElementById('playButton');
var previousButton = document.getElementById('prevButton');
var nextButton = document.getElementById('nextButton');

var currentTime = document.getElementById('currentTime');
var circle_progress = document.getElementById('circle_progress');
var buttonIconPlay = document.querySelector('#playButton i.material-icons');
let timeoutId;
var in_play = false;

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
        sound.stop();
        in_play = false;
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
    } else {
        sound.pause();
        in_play = false;
        buttonIconPlay.textContent = 'play_arrow';
    }
}

// Événement pour lire la musique
playButton.addEventListener('click', function () {
    play();
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
