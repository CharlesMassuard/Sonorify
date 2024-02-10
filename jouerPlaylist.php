<!doctype html>
<html>
    <head>
        <title>Sonorify</title>
        <link rel="icon" type="image/x-icon" href="./ressources/images/logo.png">
    </head>
</html>
<?php
    include 'player.php';
    $id_playlist = $_GET['id_playlist'] ?? 1;
    $aleatoire = $_GET['aleatoire'] ?? false;
    $musiqueStart = $_GET['musiqueStart'] ?? false;
    $aleatoire = filter_var($_GET['aleatoire'], FILTER_VALIDATE_BOOLEAN);
    require_once 'Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $musiques = $data->getMusiquesPlaylist($id_playlist);
    echo "<script type='module' src='static/js/player.js'></script>";
    echo "<script type='module'>";
    echo "import { clearPlaylist } from './static/js/player.js';";
    echo "clearPlaylist();";
    echo "</script>";
    for ($i=0; $i < count($musiques); $i++) { 
        $id_musique = $musiques[$i]['id_musique'];
        $musiqueDetails = $data->getMusique($id_musique);
        $nomMusique = addslashes($musiqueDetails['nom_musique']);
        $album = $data->getAlbumByMusique($id_musique);
        $nomAlbum = $album['titre'];
        $cover = $album['image_album'];
        $nomGroupe = $data->getNomGroupe($musiqueDetails['id_groupe'])['nom_groupe'];
        $urlMusique = $musiqueDetails['url_musique'];
        echo "<script type='module' src='static/js/player.js'></script>";
        echo "<script type='module'>";
        echo "import { addToPlaylist } from './static/js/player.js';";
        echo "import { setFirstTrack } from './static/js/player.js';";
        if($musiqueStart != false && $musiqueStart == $id_musique){
            echo "setFirstTrack('$i');";
        }
        echo "addToPlaylist('$id_musique', '$nomMusique', '$cover', '$nomGroupe', '$nomAlbum', '$urlMusique');";
        echo "</script>";
    }
    echo "<script type='module' src='static/js/player.js'></script>";
    echo "<script type='module'>";
    echo "import { playPlaylist } from './static/js/player.js';";
    if($aleatoire){
        echo "import { aleatoire } from './static/js/player.js';";
        echo "aleatoire();";
    }
    echo "playPlaylist();";
    echo "</script>";
?>