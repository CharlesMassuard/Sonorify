<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\MusicPlayerInterface;
    use Interfaces\RenderInterface;

    class Playlist implements RenderInterface {
        private $id_playlist;
        private $nom_playlist;
        private $image_playlist;
        private $public;
        private $description_playlist;
        private $moyenne_note;
        public function __construct(array $options){
            $this->id_playlist = $options['id_playlist'];
            $this->nom_playlist = $options['nom_playlist'];
            $this->image_playlist = $options['image_album'] ?? 'default.jpg';
            $this->description_playlist = $options['description_playlist'] ?? null;
            $this->public = $options['public'] ?? null;
            $this->moyenne_note = $options['moyenne_note'] ?? null;
        }
        public function render(){
            echo '<a class="a_accueil" id="Playlist" href="/Pages/Views/playlist.php?id='.$this->id_playlist.'">';
            echo '<div class="a_content">';
            echo '<img src="/static/img/'.$this->image_playlist.'">';
            echo '<h3>'.$this->nom_playlist.'</h3>';
            echo '</div>';
            echo '</a>';
        }
        public function renderPersonnal(){
            echo '<a class="a_accueil" id="Playlist" href="/Pages/Views/playlist.php?id='.$this->id_playlist.'">';
            echo '<img src="/static/img/'.$this->image_playlist.'">';
            echo '<h3>'.$this->nom_playlist.'</h3>';
            echo '<p class="infos_supp">'.$this->description_playlist.'</p>';
            $statut = $this->public ? "Publique" : "Privée";
            echo '<p class="infos_supp">'.$statut.'</p>';
            $note = $this->moyenne_note ?? "0";
            echo '<p class="infos_supp">Note : '.$note .'</p>';
            echo '</a>';
        }
    }
?>