<?php
    declare(strict_types=1);

    namespace Models;
    use Interfaces\RenderInterface;

    class Artiste implements RenderInterface {
    private $id_artiste;
    private $pseudo;
    private $image_artiste;

    public function __construct($id_artiste, $pseudo, $image_artiste){
        $this->id_artiste = $id_artiste;
        $this->pseudo = $pseudo;
        $imagePath = "./ressources/images/".$image_artiste;
        if (!file_exists($imagePath)) {
            $image_artiste = "default.jpg"; // replace with your default image name
        }
        $this->image_artiste = $image_artiste;
    }
    public function render(){
        echo '<a class="a_accueil" id="Artiste">';
        echo '<div class="a_content">';
        echo '<img src="./ressources/images/'.$this->image_artiste.'">';
        echo '<h3>'.$this->pseudo.'</h3>';
        echo '</div>';
        echo '</a>';
    }

    // implement the methods from the RenderInterface
}
?>