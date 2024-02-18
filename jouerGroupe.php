<?php
    $id_groupe = $_GET['id_groupe'] ?? 1;
    require_once 'Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $musiques = $data->getMusiquesByGroupe($id_groupe);
    $musiques = array_slice($musiques, 0, 100); //limitation pour éviter de trop charger
    shuffle($musiques);
    $render_musiques = [];
    for ($i=0; $i < count($musiques); $i++) { 
        $id_musique = $musiques[$i]['id_musique'];
        $musiqueDetails = $data->getMusique($id_musique);
        $nomMusique = $musiqueDetails['nom_musique'];
        $duree = $musiqueDetails['duree'];
        $album = $data->getAlbumByMusique($id_musique);
        $nomAlbum = $album['titre'];
        $cover = $album['image_album'];
        $nomGroupe = $data->getNomGroupe($musiqueDetails['id_groupe'])['nom_groupe'];
        $urlMusique = $musiqueDetails['url_musique'];
        $render_musiques[] = [];
        $render_musiques[$i]['id_musique'] = $id_musique;
        $render_musique[$i]['duree'] = $duree;
        $render_musiques[$i]['nom_musique'] = $nomMusique;
        $render_musiques[$i]['cover'] = $cover;
        $render_musiques[$i]['nom_groupe'] = $nomGroupe;
        $render_musiques[$i]['nom_album'] = $nomAlbum;
        $render_musiques[$i]['urlMusique'] = $urlMusique;
    }
    $musiques = [
        "musiques" => $render_musiques,
        "firstTrack" => $id_first ?? 0,
    ];
    print_r(json_encode($musiques));
?>