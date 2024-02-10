<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\MusicPlayerInterface;
    use Interfaces\RenderInterface;

    class Playlist implements RenderInterface {
        private $id_playlist;
        private $nom_playlist;
        private $id_utilisateur;
        private $liste_musiques;
        private $image_playlist;
        public function __construct(int $id_playlist, string $nom_playlist, string $image_playlist){
            $this->id_playlist = $id_playlist;
            $this->nom_playlist = $nom_playlist;
            $this->image_playlist = $image_playlist;
        }
        public function render(){
            echo '<a class="a_accueil" href= "playlist.php?id='.$this->id_playlist.'">';
            echo '<div class="a_content">';
            echo '<img src="./ressources/images/'.$this->image_playlist.'">';
            echo '<h3>'.$this->nom_playlist.'</h3>';
            echo '</div>';
            echo '</a>';
        }
    }
?>