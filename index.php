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
    <script src="./static/js/index.js" defer></script>
</head>
<?php 
    // if ($_SESSION['user'] == null) {
    //     header('Location: login.php');
    // }
?>
<body>
<main>
        <h1>Bienvenue sur mon site de streaming de musique</h1>
        <form action="search.php" method="get">
            <input type="text" id="search" placeholder="Rechercher un titre, un groupe, un artiste, un album, un genre">
            <input type="submit" value="Rechercher">
        </form>
        <section id="search_result">
        </section>
        <div id="playlist">
            <h2>Playlists</h2>
            <?php 
            $playlists = $data->getPlaylists();
            foreach ($playlists as $playlist) {
                echo '<a href= "playlist.php?id='.$playlist['id_playlist'].'">';
                echo '<h2>'.$playlist['nom_playlist'].'</h2>';
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
                echo '<img src="./ressources/images/'.$album['image_album'].'">';
                echo '<h2>'.$album['titre'].'</h2>';
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
                echo '<h2>'.$genre['nom_genre'].'</h2>';
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
                echo '<h2>'.$groupe['nom_groupe'].'</h2>';
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
    </main>
</body>
</html>