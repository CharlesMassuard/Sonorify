<?php
    use Models\{Album, Musique};
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
                array_push($listeMusiques, new Musique($musique["id_musique"], $musique["nom_musique"], $musique["duree"], $musique["nom_groupe"], $musique["id_album"], $musique["id_genre"]));
            }
            return $listeMusiques;
        }
    }
?>