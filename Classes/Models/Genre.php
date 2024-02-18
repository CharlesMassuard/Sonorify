<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Genre implements RenderInterface {
        private int $id_genre;
        private string $nom_genre;
        private string $image_genre;

        public function __construct(int $id_genre, string $nom_genre, ?string $image_genre){
            $this->id_genre = $id_genre;
            $this->nom_genre = $nom_genre;
            if ($image_genre === null || !file_exists("./ressources/images/".$image_genre)) {
                $image_genre = "default.jpg"; // replace with your default image name
            }
            $this->image_genre = $image_genre;
        }

        public function render(){
            echo '<a class="a_accueil" id="Genre" href= "genre.php?id='.$this->id_genre.'">';
            echo '<div class="a_content">';
            echo '<img src="./ressources/images/'.$this->image_genre.'">';
            echo '<h3>'.$this->nom_genre.'</h3>';
            echo '</div>';
            echo '</a>';
        }
    }
?>