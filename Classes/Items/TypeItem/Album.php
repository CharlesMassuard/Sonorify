<?php
    declare(strict_types=1);

    namespace Items\TypeItem;
    
    class Album implements MusicPlayerInterface, RenderInterface {
        private $id_album;
        private $titre;
        private $image_album;
        private $id_artiste;
        private $dateSortie;
    
        // implement the methods from the interfaces
    }
?>