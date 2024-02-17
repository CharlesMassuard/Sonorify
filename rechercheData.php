<?php
$data = $_POST['data'] ?? "gro";
rechercheData($data);

function rechercheData($data) {
    require_once 'Classes/Data/DataBase.php';
    $database = new Data\DataBase();
    $groupes = $database->getGroupesByName( $data ?? null);
    $resultats = [];
    $resultats['groupes'] = array_slice($groupes, 0, 6);
    if ($groupes !== null && is_array($groupes) && count($groupes)  == 1){
        $resultats['albums'] = array_slice($database->getAlbumsByIdGroupe($groupes[0]['id_groupe']), 0, 6);
        $musiques = array_slice($database->getMusiquesByName($data), 0, 6);
        $musiquesGroupe = array_slice($database->getMusiquesByIdGroupe($groupes[0]['id_groupe']), 0, 6);
        foreach($musiquesGroupe as $musiqueGroupe) {
            if($musiqueGroupe['titre'] != $data) {
                $musiques[] = $musiqueGroupe;
            }
        }
        $resultats['musiques'] = $musiques;
    } else {
        $playlists = array_slice($database->getPlaylistsByName($data), 0, 6);
        $genres = array_slice($database->getGenresByName($data), 0, 6);
        $albums = array_slice($database->getAlbumsByName($data), 0, 6);
        $resultats['albums'] = $albums;
        $resultats['playlists'] = $playlists;
        $resultats['genres'] = $genres;
        $musiques = array_slice($database->getMusiquesByName($data), 0, 6);
        $resultats['musiques'] = $musiques;
    }
    print_r(json_encode($resultats));
}
?>