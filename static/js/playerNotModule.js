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