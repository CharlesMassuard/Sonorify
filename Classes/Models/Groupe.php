<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Groupe implements RenderInterface {
        private int $id_groupe;
        private string $nom_groupe;
        private string $description_groupe;
        private string $image_groupe;

        public function __construct(int $id_groupe, string $nom_groupe, string $description_groupe, string $image_groupe){
            $this->id_groupe = $id_groupe;
            $this->nom_groupe = $nom_groupe;
            $this->description_groupe = $description_groupe;
            $imagePath = "./ressources/images/".$image_groupe;
            if (!file_exists($imagePath)) {
                $image_groupe = "default.jpg"; // replace with your default image name
            }
            $this->image_groupe = $image_groupe;
        }
        
        public function render(){
            echo '<a class="a_accueil" id="Groupe" href= "groupe.php?id='.$this->id_groupe.'">';
            echo '<div class="a_content">';
            echo '<img src="./ressources/images/'.$this->image_groupe.'">';
            echo '<h3>'.$this->nom_groupe.'</h3>';
            echo '</div>';
            echo '</a>';
        }
    }
?>