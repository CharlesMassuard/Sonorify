<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\MusicPlayerInterface;
    use Interfaces\RenderInterface;
    
    class Album implements MusicPlayerInterface, RenderInterface {
        private $id_album;
        private $titre;
        private $image_album;
        private $id_artiste;
        private $dateSortie;
        private $note;
    
        // implement the methods from the interfaces
    }
?>