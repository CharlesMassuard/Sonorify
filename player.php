<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="./static/css/player.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/84/three.min.js'></script>
    <script src='https://cdn.rawgit.com/mrdoob/three.js/master/examples/js/controls/OrbitControls.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.3/dat.gui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/simplex-noise/2.3.0/simplex-noise.min.js'></script>
    <script type="module" src="./static/js/player.js" defer></script>
</head>
<div id="customPlayer">
    <div id="progressBar">
        <div id="progress">
            <div id="circle_progress"></div>
        </div>
    </div>
    <div class="infos">
        <div class="controls">
            <button id="prevButton" title="Précédent"><i class="material-icons">skip_previous</i></button>
            <button id="playButton" title="Lire"><i class="material-icons">play_arrow</i></button>
            <button id="nextButton" title="Suivant"><i class="material-icons">skip_next</i></button>
            <div id="currentTimeDisplay">--:-- / --:--</div>
        </div>
        <div id="infos_music">
            <img id="cover" src="./ressources/images/TerryAllen_Juarez.jpg" alt="cover">
            <div id='infos_ecrites'>
                <h4 id="title">Finale</h4>
                <div class="infos_supplementaires"><a title="Voir l'artiste" class="infos_music" href="artiste">Gareth Coker</a>&nbsp; • &nbsp;<a title="Voir l'album" class="infos_music" href="album">ARK: Genesis Part 2 (Original Soundtrack)</a>&nbsp; •&nbsp; <a title="Voir les sorties de l'année" class="infos_music" href="date">2021</a></div>
            </div>
        </div>
        <div class="controls2">
            <div id="progressVolume">
                <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1" onchange="changeVolume(value)" oninput="changeVolume(value)">
            </div>
            <button id="volumeButton" title="Désactiver le son"><i class="material-icons">volume_up</i></button>
            <button id="repeatButton" title="Activer la répétition"><i class="material-icons">repeat</i></button>
            <button id="shuffleButton" title="Lecture aléatoire"><i class="material-icons">shuffle</i></button>
            <button id="visualizerButton" title="Afficher le visualiseur"><i class="material-icons">equalizer</i></button>
            <button id="arrowUp" title="Afficher les détails" onclick="toggleSection()"><i class="material-icons">arrow_drop_up</i></button>        
        </div>
    <!-- <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1"> -->
    </div>
</div>
</html>