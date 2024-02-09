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
        $resultats['musiques'] = $database->getMusiquesByIdGroupe($groupes[0]['id_groupe']);
    } else {
        $playlists = $database->getPlaylistsByName($data);
        $genres = $database->getGenresByName($data);
        $albums = $database->getAlbumsByName($data);
        $resultats['albums'] = $albums;
        $resultats['playlists'] = $playlists;
        $resultats['genres'] = $genres;
        if(count($resultats['albums']) + count($resultats['playlists']) + count($resultats['genres']) > 1){
            $musiques = $database->getMusiquesByName($data);
        } else if (count($resultats['albums']) + count($resultats['playlists']) + count($resultats['genres']) == 1){
            if(count($resultats['albums']) == 1){
                $musiques = $database->getMusiquesByIdAlbum($resultats['albums'][0]['id_album']);
            } else if(count($resultats['playlists']) == 1){
                $musiques = $database->getMusiquesByIdPlaylist($resultats['playlists'][0]['id_playlist']);
            } else if(count($resultats['genres']) == 1){
                $musiques = $database->getMusiquesByIdGenre($resultats['genres'][0]['id_genre']);
            }
        }
        $resultats['musiques'] = $musiques;
    }
    print_r(json_encode($resultats));
}
?>