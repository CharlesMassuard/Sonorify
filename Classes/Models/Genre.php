<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Genre implements RenderInterface {
        private $id_genre;
        private $nom_genre;
        private $image_genre;
        public function __construct($id_genre, $nom_genre, $image_genre){
            $this->id_genre = $id_genre;
            $this->nom_genre = $nom_genre;
            $this->image_genre = $image_genre;
        }

        public function render(){
            echo '<a class="a_accueil" href= "genre.php?id='.$this->id_genre.'">';
            echo '<div class="a_content">';
            echo '<img src="./ressources/images/'.$this->image_genre.'">';
            echo '<h3>'.$this->nom_genre.'</h3>';
            echo '</div>';
            echo '</a>';
        }

        // reste
    }