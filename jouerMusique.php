<?php
    include 'player.php';
    $id_musique = $_GET['id_musique'] ?? 1;
    require_once 'Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $musiqueDetails = $data->getMusique($id_musique);
    $nomMusique = addslashes($musiqueDetails['nom_musique']);
    $album = $data->getAlbumByMusique($id_musique);
    $nomAlbum = $album['titre'];
    $cover = $album['image_album'];
    $nomGroupe = $data->getNomGroupe($musiqueDetails['id_groupe'])['nom_groupe'];
    $urlMusique = $musiqueDetails['url_musique'];
    echo "<script type='module' src='static/js/player.js'></script>";
    echo "<script type='module'>";
    echo "import { addPlaylist } from './static/js/player.js';";
    echo "import { playPlaylist } from './static/js/player.js';";
    echo "addPlaylist('$nomMusique', '$cover', '$nomGroupe', '$nomAlbum', '$urlMusique');";
    echo "playPlaylist();";
    echo "</script>";
    // header('Location: index.php');
?>