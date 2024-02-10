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
<?php include 'player.php'; ?>
<body>
    <?php include 'aside.php'; ?>
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
                $musiques = $data->getMusiqueRecemmentEcoutee();
                if(count($musiques) == 0) {
                    $musiques = $data->getMusiqueRecente();
                    echo '<h2>Musiques</h2>';
                } else {
                    echo '<h2>Musiques Recemment Ecoutées</h2>';
                }
            }
            echo '<div id="musiques" class="sections_accueil">';
            foreach ($musiques as $musique) {
                echo "<a class='a_accueil' href='jouerMusique.php?id_musique={$musique['id_musique']}'>";
                echo '<div class="a_content">';
                $album = $data->getAlbumByMusique($musique['id_musique']);
                echo '<img src="./ressources/images/'.$album['image_album'].'">';
                echo '<h3>'.$musique['nom_musique'].'</h3>';
                echo '<p class="infos_supp">'.$data->getNomGroupe($musique['id_groupe'])['nom_groupe'].'</p>';
                echo '</div>';
                echo '</a>';
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
            foreach ($albums as $album) {

                echo '<a class="a_accueil" href= "album.php?id='.$album['id_album'].'">';
                echo '<div class="a_content">';
                echo '<img src="./ressources/images/'.$album['image_album'].'">';
                echo '<h3>'.$album['titre'].'</h3>';
                echo '<p class="infos_supp">'.$data->getNomGroupe($album['id_groupe'])['nom_groupe'].'</p>';
                echo '</div>';
                echo '</a>';
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
                echo '<img src="./ressources/images/'.$genre['image_genre'].'">';
                echo '<h3>'.$genre['nom_genre'].'</h3>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
        <h2>Groupes et Artistes</h2>
        <div id="groupes" class="sections_accueil">
            <?php 
            $groupes = $data->getGroupes();
            foreach ($groupes as $groupe) {
                echo '<a class="a_accueil" href= "">';
                echo '<div class="a_content">';
                echo '<img src="./ressources/images/'.$groupe['image_groupe'].'">';
                echo '<h3>'.$groupe['nom_groupe'].'</h3>';
                echo '</div>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="bottomPage" class="sections_accueil"></div>
    </main>
</body>
</html>