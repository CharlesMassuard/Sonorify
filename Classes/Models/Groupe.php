<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Groupe implements RenderInterface {
        private $id_groupe;
        private $nom_groupe;
        private $description_groupe;
        private $image_groupe;
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
            echo '<a class="a_accueil" id="Groupe" href= "/Pages/Views/groupe.php?id='.$this->id_groupe.'">';
            echo '<div class="a_content">';
            echo '<img src="/static/img/'.$this->image_groupe.'">';
            echo '<h3>'.$this->nom_groupe.'</h3>';
            echo '</div>';
            echo '</a>';
        }
    
        // implement the methods from the RenderInterface
    }
?>