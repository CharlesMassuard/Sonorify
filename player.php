<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        $id_playlist = $_GET['id'] ?? 1;
        require_once 'Classes/Data/DataBase.php';
        $data = new Data\DataBase();
        $playlist = $data->getPlaylist($id_playlist);
        $musiques = $data->getMusiquesPlaylist($id_playlist);
        $nbrMusiques = count($musiques);
    }
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="./static/css/player.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.3/dat.gui.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/simplex-noise/2.3.0/simplex-noise.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="./static/js/player.js" defer></script>
    
</head>
<?php include 'bigPlayer.php'; ?>
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
            <img id="cover" src="" alt="cover">
            <div id='infos_ecrites'>
                <h4 id="title">Finale</h4>
                <div class="infos_supplementaires"><a title="Voir l'artiste" class="infos_music" href="artiste" id="nomArtiste"></a>&nbsp; • &nbsp;<a title="Voir l'album" class="infos_music" href="album" id="nomAlbum"></a></div>
            </div>
            <div id="dropUpMusic">
                <button id="moreMusic" title="Plus d'options"><i class="material-icons">more_vert</i></button>
                <div id="optionsMusic">
                    <button id="likeButton" title="Ajouter aux favoris"><i class="material-icons">favorite_border</i></button>
                    <button id="playlistButton" title="Ajouter à une playlist"><i class="material-icons">playlist_add</i></button>
                </div>
            </div>
        </div>
        <div class="controls2">
            <div id="progressVolume">
                <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1">
            </div>
            <button id="volumeButton" title="Désactiver le son"><i class="material-icons">volume_up</i></button>
            <button id="repeatButton" title="Activer la répétition"><i class="material-icons">repeat</i></button>
            <button id="shuffleButton" title="Lecture aléatoire"><i class="material-icons">shuffle</i></button>
            <!-- <a href= "audioVisualizer.php" title="Afficher le visualisateur audio" id="audioVisualizer"><i class="material-icons">equalizer</i></a> -->
            <button id="arrowUp" title="Afficher les détails"><i class="material-icons">arrow_drop_up</i></button>        
        </div>
    <!-- <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1"> -->
    </div>
</div>
</html>