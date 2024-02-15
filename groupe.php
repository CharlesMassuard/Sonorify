<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_groupe = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    require 'Classes/Autoloader.php';
    Autoloader::register();
    $groupe = $data->getGroupeById($id_groupe);
    $nbMusiques = count($data->getMusiquesByGroupe($id_groupe));
    $musiques = $data->getMusiquesAleatoireByGroupe($id_groupe);
    $musiques = Factory::createMusiques($musiques);
    $nbAlbums = count($data->getAlbumsByGroupe($id_groupe));
    $albums = $data->getAlbumsAleatoireByGroupe($id_groupe);
    $albums = Factory::createAlbums($albums);
    $artistes = $data->getArtistesByGroupe($id_groupe);
    $artistes = Factory::createArtistes($artistes);
?>

<header>
    <link rel="stylesheet" href="./static/css/groupe.css">
</header>

<div id="headerGroupe">
    <img id="imgGroupe" src="./ressources/images/<?php echo $groupe['image_groupe']?>">
    <div id="infosGroupe">
        <h1><?php echo $groupe['nom_groupe'] ?></h1>
        <p id="descGroupe"><?php echo $groupe['description_groupe'] ?></p>
        <?php
        echo '<div id="inputGroupe">';
        echo '<form id="playGroupe" action="jouerGroupe.php?id_groupe='.$id_groupe.' method="post">';
        echo '<input type="submit" id="jouerGroupe" name="jouerGroupe" style="display: none;">';
        echo '<label for="jouerGroupe"  title="Ecouter le groupe"><i class="material-icons">play_arrow</i></label>';
        echo '</form>';
        echo '</div>';
        ?>
    </div>
</div>

<div id="sections_groupes">
    <div id="musiquesGroupe">
        <div id="titleMusiquesGroupe">
            <h1>Musiques</h1>
            <?php if($nbMusiques > 12) { ?>
                <button id="voirPlus" title="Voir toutes les musiques">Voir plus</button>
            <?php } ?>
        </div>
        <div id="listeMusiquesGroupe">
            <?php
            foreach ($musiques as $musique) {
                echo $musique -> render();
            }
            ?>
        </div>
    </div>

    <div id="albumsGroupe">
        <div id="titleMusiquesGroupe">
            <h1>Albums</h1>
            <?php if($nbAlbums > 12) { ?>
                <button id="voirPlus" title="Voir tous les albums">Voir plus</button>
            <?php } ?>
        </div>
        <div id="listeMusiquesGroupe">
            <?php
            foreach ($albums as $album) {
                echo $album -> render();
            }
            ?>
        </div>
    </div>
</div>
