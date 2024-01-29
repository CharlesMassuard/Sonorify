<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\MusicPlayerInterface;
    use Interfaces\RenderInterface;

    class Playlist {
        private $id_playlist;
        private $nom_playlist;
        private $id_utilisateur;
        private $liste_musiques;
    }
?>