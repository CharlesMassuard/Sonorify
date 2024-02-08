<?php
$data = $_POST['data'] ?? "gro";
rechercheData($data);

function rechercheData($data) {
    require_once 'Classes/Data/DataBase.php';
    $database = new Data\DataBase();
    $groupes = $database->getGroupesByName( $data ?? null);
    $resultats = [];
    $resultats['groupes'] = $groupes;
    if ($groupes !== null && is_array($groupes) && count($groupes)  == 1){
        $resultats['albums'] = $database->getAlbumsByIdGroupe($groupes[0]['id_groupe']);
        // $resultats['albums'] = $database->getAlbums();
    } else {
        $playlists = $database->getPlaylistsByName($data);
        $genres = $database->getGenresByName($data);
        $albums = $database->getAlbumsByName($data);
        $musiques = $database->getMusiquesByName($data);
        $resultats['musiques'] = $musiques;
        $resultats['albums'] = $albums;
        $resultats['playlists'] = $playlists;
        $resultats['genres'] = $genres;
    }
    print_r(json_encode($resultats));
}
?>