<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\MusicPlayerInterface;
    use Interfaces\RenderInterface;

    class Musique implements MusicPlayerInterface, RenderInterface {
        private $id_musique;
        private $nom_musique;
        private $duree;
        private $nom_groupe;
        private $id_album;
        private $id_genre;
        public function __construct(int $id_musique, string $nom_musique, string $duree, string $nom_groupe, int $id_album, int $id_genre){
            $this->id_musique = $id_musique;
            $this->nom_musique = $nom_musique;
            $this->duree = $duree;
            $this->nom_groupe = $nom_groupe;
            $this->id_album = $id_album;
            $this->id_genre = $id_genre;
        }

        public function render(){
            echo '<a class="a_accueil" href= "">';
            echo '<div class="a_content">';
            echo '<h3>'.$this->nom_musique.'</h3>';
            echo '<p class="infos_supp">'.$this->nom_groupe.'</p>';
            echo '</div>';
            echo '</a>';
        }

        public function play(){
            echo "Playing musique";
        }
    }
?>