<?php
$data = $_POST['data'] ?? "gro";
rechercheData($data);

function rechercheData($data) {
    require_once 'Classes/Data/DataBase.php';
    $database = new Data\DataBase();
    $groupes = $database->getGroupesByName( $data ?? null);
    $resultats = [];
    $resultats['groupes'] = array_slice($groupes, 0, 4);
    if ($groupes !== null && is_array($groupes) && count($groupes)  == 1){
        $resultats['albums'] = array_slice($database->getAlbumsByIdGroupe($groupes[0]['id_groupe']), 0, 4);
        $musiques = array_slice($database->getMusiquesByName($data), 0, 4);
        $musiquesGroupe = array_slice($database->getMusiquesByIdGroupe($groupes[0]['id_groupe']), 0, 4);
        foreach($musiquesGroupe as $musiqueGroupe) {
            if($musiqueGroupe['titre'] != $data) {
                $musiques[] = $musiqueGroupe;
            }
        }
        // Limit the total number of musics to 4
        $musiques = array_slice($musiques, 0, 4);
        $resultats['musiques'] = $musiques;
    } else {
        $playlists = array_slice($database->getPlaylistsByName($data), 0, 4);
        $genres = array_slice($database->getGenresByName($data), 0, 4);
        $albums = array_slice($database->getAlbumsByName($data), 0, 4);
        $resultats['albums'] = $albums;
        $resultats['playlists'] = $playlists;
        $resultats['genres'] = $genres;
        $musiques = array_slice($database->getMusiquesByName($data), 0, 4);
        $resultats['musiques'] = $musiques;
    }
    print_r(json_encode($resultats));
}
?>