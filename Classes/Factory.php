<?php
    use Models\{Album, Musique, Genre, Playlist, Groupe, Artiste};
    class Factory{
        public static function createAlbums(Array $data): Array{
            $listeAlbums = [];
            foreach($data as $album){
                array_push($listeAlbums, new Album($album["id_album"], $album["titre"], $album["dateSortie"], $album["image_album"], $album["nom_groupe"]));
            }
            return $listeAlbums;
        }
        public static function createMusiques(Array $data): Array{
            $listeMusiques = [];
            foreach($data as $musique){
                array_push($listeMusiques, new Musique($musique["id_musique"], $musique["nom_musique"], $musique["duree"], $musique["nom_groupe"], $musique["id_album"], $musique["id_genre"], $musique["image_album"]));
            }
            return $listeMusiques;
        }
        public static function createGenres(Array $data): Array{
            $listeGenres = [];
            foreach($data as $genre){
                array_push($listeGenres, new Genre($genre["id_genre"], $genre["nom_genre"], $genre["image_genre"]));
            }
            return $listeGenres;
        }
        public static function createPlaylists(Array $data): Array{
            $listePlaylists = [];
            foreach($data as $playlist){
                array_push($listePlaylists, new Playlist($playlist["id_playlist"], $playlist["nom_playlist"], $playlist["image_album"]));
            }
            return $listePlaylists;
        }
        public static function createGroupes(Array $data): Array{
            $listeGroupes = [];
            foreach($data as $groupe){
                array_push($listeGroupes, new Groupe($groupe["id_groupe"], $groupe["nom_groupe"], $groupe["description_groupe"], $groupe["image_groupe"]));
            }
            return $listeGroupes;
        }
        public static function createArtistes(Array $data): Array{
            $listeArtistes = [];
            foreach($data as $artiste){
                array_push($listeArtistes, new Artiste($artiste["id_artiste"], $artiste["pseudo_artiste"], $artiste["image_artiste"]));
            }
            return $listeArtistes;
        }
    }
?>