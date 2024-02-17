<?php
    $id_playlist = $_GET['id_playlist'] ?? 1;
    $aleatoire = $_GET['aleatoire'] ?? false;
    $musiqueStart = $_GET['musiqueStart'] ?? false;
    $aleatoire = filter_var($_GET['aleatoire'], FILTER_VALIDATE_BOOLEAN);
    require_once '../../Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $musiques = $data->getMusiquesPlaylist($id_playlist);
    if($aleatoire){
        shuffle($musiques);
    }
    // print_r($musiques);
    // echo "<script type='module'>";
    // echo "import { clearPlaylist } from './static/js/player.js';";
    // echo "clearPlaylist();";
    // echo "</script>";
    $render_musiques = [];
    for ($i=0; $i < count($musiques); $i++) { 
        $id_musique = $musiques[$i]['id_musique'];
        $musiqueDetails = $data->getMusique($id_musique);
        $nomMusique = $musiqueDetails['nom_musique'];
        $album = $data->getAlbumByMusique($id_musique);
        $nomAlbum = $album['titre'];
        $cover = $album['image_album'];
        $nomGroupe = $data->getNomGroupe($musiqueDetails['id_groupe'])['nom_groupe'];
        $urlMusique = $musiqueDetails['url_musique'];
        // echo "<script type='module' src='static/js/player.js'></script>";
        // echo "<script type='module'>";
        // echo "import { addToPlaylist } from './static/js/player.js';";
        // echo "import { setFirstTrack } from './static/js/player.js';";
        if($musiqueStart != false && $musiqueStart == $id_musique){
            $id_first = $i;
        }
        // echo "addToPlaylist('$id_musique', '$nomMusique', '$cover', '$nomGroupe', '$nomAlbum', '$urlMusique');";
        $render_musiques[] = [];
        $render_musiques[$i]['id_musique'] = $id_musique;
        $render_musiques[$i]['nom_musique'] = $nomMusique;
        $render_musique[$i]['duree'] = $musiqueDetails['duree'];
        $render_musiques[$i]['cover'] = $cover;
        $render_musiques[$i]['nom_groupe'] = $nomGroupe;
        $render_musiques[$i]['nom_album'] = $nomAlbum;
        $render_musiques[$i]['urlMusique'] = $urlMusique;
        // echo "</script>";
    }
    $musiques = [
        "musiques" => $render_musiques,
        "firstTrack" => $id_first ?? 0,
    ];
    print_r(json_encode($musiques));
    // echo "<script type='module' src='static/js/player.js'></script>";
    // echo "<script type='module'>";
    // echo "import { playPlaylist } from './static/js/player.js';";
    // echo "playPlaylist();";
    // echo "</script>";
    // header('Location: playlist.php?id='.$id_playlist);
?>