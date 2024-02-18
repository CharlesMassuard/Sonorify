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
            $imagePath2 = __DIR__ ."/../../ressources/images/".$image_album;
            if (file_exists($imagePath) ) {
                $this->image_album = "/static/img/".$image_album;
            } 
            else if (file_exists($imagePath2)) {
                $this->image_album = "/ressources/images/".$image_album;
            }
            else {
                $this->image_album = "/static/img/default.jpg"; // replace with your default image name
            }
            $this->nom_groupe = $nom_groupe;
        }

        public function render(){
            echo '<a class="a_accueil" href= "/Pages/Views/album.php?id='.$this->id_album.'" id="Album">';
            echo '<div class="a_content">';
            echo '<img src="'.$this->image_album.'">';
            echo '<h3>'.$this->titre.'</h3>';
            echo '<p class="infos_supp">'.$this->nom_groupe.'</p>';
            echo '</div>';
            echo '</a>';
        }
    }
?>