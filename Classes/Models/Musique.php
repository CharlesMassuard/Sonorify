<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Musique implements RenderInterface {
        private int $id_musique;
        private string $nom_musique;
        private string $duree;
        private string$nom_groupe;
        private int $id_album;
        private int $id_genre;
        private string $image_musique;

        public function __construct(int $id_musique, string $nom_musique, string $duree, string $nom_groupe, int $id_album, int $id_genre, string $image_musique = null){
            $this->id_musique = $id_musique;
            $this->nom_musique = $nom_musique;
            $this->duree = $duree;
            $this->nom_groupe = $nom_groupe;
            $this->id_album = $id_album;
            $this->id_genre = $id_genre;
            $this->image_musique = $image_musique;
        }

        public function render(){
            echo '<a class="a_accueil" href= "jouerMusique.php?id='.$this->id_musique.'" id="PlayMusique">';
            echo '<div class="a_content">';
            echo '<img src="./ressources/images/'.$this->image_musique.'">';
            echo '<h3>'.$this->nom_musique.'</h3>';
            echo '<p class="infos_supp">'.$this->nom_groupe.'</p>';
            echo '</div>';
            echo '</a>';
            echo '<div id="context-menu" style="display: none; position: absolute;">';
            echo '<ul id="optionsAccueil">';
            echo '<li>Option 1</li>';
            echo '<li>Option 2</li>';
            echo '<li>Option 3</li>';
            echo '</ul>';
            echo '</div>';
        }
    }
?>