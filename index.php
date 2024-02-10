<?php
declare(strict_types=1);
session_start();

// Autoload
require 'Classes/Autoloader.php';
Autoloader::register();

use Data\DataBase;
$data = new DataBase();
?>

<!doctype html>
<html>
<head>
    <title>Sonorify</title>
    <link rel="icon" type="image/x-icon" href="./ressources/images/logo.png">
    <link rel="stylesheet" href="./static/css/index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./static/js/index.js" defer></script>
    <script src="./static/js/accueil.js" defer></script>
</head>
<body>
    <?php include 'aside.php'; ?>
    <?php include 'bigPlayer.php'; ?>
    <main>
        <?php include 'header.php'; ?>
        <div id="titre">
            <?php
                if (!isset($_SESSION['user'])) {
                    echo '<h1> Bienvenue </h1>';
                } else {
                    echo '<h1> Bienvenue '.$_SESSION['user']['prenom_utilisateur'].'</h1>';
                }
            ?>
        </div>
        
        <?php
            if (!isset($_SESSION['user'])) {
                echo '<h2>Musiques</h2>';
                $musiques = $data->getMusiqueRecente();
            } else {
                echo '<h2>Vos Musiques Récentes</h2>';
                $musiques = $data->getMusiqueRecemmentEcoutee();

            }
            $musiques = Factory::createMusiques($musiques);
            echo '<div id="musiques" class="sections_accueil">';
            foreach ($musiques as $musique) {
                $musique->render();
            }
            echo '</div>';
        ?>
        <h2>Playlists</h2>
        <div id="playlist" class="sections_accueil">
            <?php 
            $playlists = $data->getPlaylistsTrieesParNote();
            foreach ($playlists as $playlist) {
                echo '<a class="a_accueil" href= "playlist.php?id='.$playlist['id_playlist'].'">';
                echo '<div class="a_content">';
                $image = $data->getMusiquesAlbumsByPlaylist($playlist['id_playlist'])['image_album'] ?? 'default.jpg';
                echo '<img src="./ressources/images/'.$image.'">';
                echo '<h3>'.$playlist['nom_playlist'].'</h3>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
        <h2>Albums</h2>
        <div id="albums" class="sections_accueil">
            <?php 
            $albums = $data->getAlbums();
            $albums = Factory::createAlbums($albums);
            foreach ($albums as $album) {
                $album->render();
            }
            ?>
        </div>
        <h2>Genres</h2>
        <div id="genres" class="sections_accueil">
            <?php 
            $genres = $data->getGenres();
            foreach ($genres as $genre) {
                echo '<a class="a_accueil" href= "">';
                echo '<div class="a_content">';
                echo '<h3>'.$genre['nom_genre'].'</h3>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
        <h2>Groupes</h2>
        <div id="groupes" class="sections_accueil">
            <?php 
            $groupes = $data->getGroupes();
            foreach ($groupes as $groupe) {
                echo '<a class="a_accueil" href= "">';
                echo '<div class="a_content">';
                echo '<h3>'.$groupe['nom_groupe'].'</h3>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="bottomPage" class="sections_accueil"></div>
    </main>
</body>
<?php include 'player.php'; ?>
</html>