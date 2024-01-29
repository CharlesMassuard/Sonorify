<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Groupe implements RenderInterface {
        private $id_groupe;
        private $nom_groupe;
        private $description_groupe;
        private $liste_artistes;
        private $image_groupe;
    
        // implement the methods from the RenderInterface
    }
?>