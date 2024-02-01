<?php
declare(strict_types=1);
session_start();

require_once 'Data/DataBase.php';
$data = new Data\DataBase();

// Autoload
require 'Classes/Autoloader.php';
Autoloader::register();
?>

<!doctype html>
<html>
<head>
    <title>PHP'O SONG</title>
    <link rel="stylesheet" href="./static/css/index.css">
    <script src="./static/js/accueil.js" defer></script>
</head>
<?php 
    // if ($_SESSION['user'] == null) {
    //     header('Location: login.php');
    // }
?>
<body>
<main>
        <div id="titre">
            <?php
                if ($_SESSION['user'] == null) {
                    echo '<h1> Bienvenue </h1>';
                } else {
                    echo '<h1> Bienvenue, '.$_SESSION['user']['prenom_utilisateur'].'</h1>';
                }
            ?>
        </div>
        <div id="playlist">
            <h2>Playlists</h2>
            <?php 
            require_once 'Data/DataBase.php';
            $data = new Data\DataBase();
            $playlists = $data->getPlaylists();
            foreach ($playlists as $playlist) {
                echo '<a href= "">';
                echo '<h3>'.$playlist['nom_playlist'].'</h3>';
                echo '<p>'.$playlist['description_playlist'].'</p>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="albums">
            <h2>Albums</h2>
            <?php 
            $albums = $data->getAlbums();
            foreach ($albums as $album) {
                echo '<a href= "">';
                echo '<h3>'.$album['nom_album'].'</h3>';
                echo '<p>'.$album['description_album'].'</p>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="genres">
            <h2>Genres</h2>
            <?php 
            $genres = $data->getGenres();
            foreach ($genres as $genre) {
                echo '<a href= "">';
                echo '<h3>'.$genre['nom_genre'].'</h3>';
                echo '<p>'.$genre['description_genre'].'</p>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="groupes">
            <h2>Groupes</h2>
            <?php 
            $groupes = $data->getGroupes();
            foreach ($groupes as $groupe) {
                echo '<a href= "">';
                echo '<h3>'.$groupe['nom_groupe'].'</h3>';
                echo '<p>'.$groupe['description_groupe'].'</p>';
                echo '</a>';
            }
            ?>
        </div>
        <!-- <div id="player">
            <h2>Titre de la chanson</h2>
            <audio controls="controls">
                <source src="musics/ARK_MainTheme.mp3">
            </audio>
            <div id="video">
                <h2>Titre de la vidéo</h2>
                <iframe  width="560" height="315" src="https://drive.google.com/uc?export=download&id=1a4URD6ChccVe9BPDy8xnOUXtsC4kZGea" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/1f2V8U1BiWaC9aJWmpOARe?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div> -->
        <div id="circle"></div>
    </main>
</body>
</html>