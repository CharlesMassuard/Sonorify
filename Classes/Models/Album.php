<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;
    
    class Album implements RenderInterface {
        private int $id_album;
        private string $titre;
        private string $image_album;
        private int $id_groupe;
        private string $dateSortie;
    
        public function __construct(int $id_album, string $titre, string $dateSortie, string $image_album, string $nom_groupe){
            $this->id_album = $id_album;
            $this->titre = $titre;
            $this->dateSortie = $dateSortie;
            $imagePath = __DIR__ ."/../../static/img/".$image_album;
            if (!file_exists($imagePath)) {
                $image_album = "default.jpg"; // replace with your default image name
            }
            $this->image_album = $image_album;
            $this->nom_groupe = $nom_groupe;
        }

        public function render(){
            echo '<a class="a_accueil" href= "/Pages/Views/album.php?id='.$this->id_album.'" id="Album">';
            echo '<div class="a_content">';
            echo '<img src="/static/img/'.$this->image_album.'">';
            echo '<h3>'.$this->titre.'</h3>';
            echo '<p class="infos_supp">'.$this->nom_groupe.'</p>';
            echo '</div>';
            echo '</a>';
        }
    }
?>