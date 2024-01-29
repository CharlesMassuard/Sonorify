<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\MusicPlayerInterface;
    use Interfaces\RenderInterface;

    class Musique implements MusicPlayerInterface, RenderInterface {
        private $id_musique;
        private $nom_musique;
        private $duree;
        private $id_groupe;
        private $id_album;
        private $id_genre;
    }
?>