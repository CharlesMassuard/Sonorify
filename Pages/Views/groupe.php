<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_groupe = $_GET['id'] ?? 1;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    require dirname(__FILE__) . '/../../Classes/Autoloader.php';
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
    <img id="imgGroupe" src="/static/img/<?php echo $groupe['image_groupe']?>">
    <div id="infosGroupe">
        <h1><?php echo $groupe['nom_groupe'] ?></h1>
        <p id="descGroupe"><?php echo $groupe['description_groupe'] ?></p>
        <?php
        echo '<div id="inputGroupe">';
        echo '<form id="PlayGroupe" action="jouerGroupe.php?id_groupe='.$id_groupe.'" method="post">';
        echo '<input type="submit" id="jouerGroupe" name="jouerGroupe" style="display: none;">';
        echo '<label for="jouerGroupe"  title="Ecouter le groupe"><i class="material-icons">play_arrow</i></label>';
        echo '</form>';
        // if ($_SESSION  && isset($_SESSION['user']) && is_array($_SESSION) && $data->isFavorisAlbum($id_album, $_SESSION['user']['id_utilisateur']) ?? false){
        //     echo '<form id="FavorisGroupe" action="supprimerFavorisGroupe.php?id='.$id_album.'" method="post">';
        //     echo '<input type="submit" id="favAlbum" name="deleteFavoriteAlbum" style="display: none;">';
        //     echo '<label for="favAlbum"  title="Supprimer des favoris"><i class="material-icons" id="UnFav">favorite</i></label>';
        //     echo '</form>';
        // } else {
        //     echo '<form id="Favoris" action="ajouterFavorisAlbum.php?id='.$id_album.'" method="post">';
        //     echo '<input type="submit" id="favAlbum" name="addFavoriteAlbum" style="display: none;">';
        //     echo '<label for="favAlbum"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite_border</i></label>';
        //     echo '</form>';
        // }
        echo '</div>';
        ?>
    </div>
</div>

<div id="sections_groupes">
    <div id="musiquesGroupe">
        <div id="titleMusiquesGroupe">
            <h1>Musiques</h1>
            <?php if($nbMusiques > 12) {
                echo '<a href="allGroupe.php?id_groupe='.$id_groupe.'&type=musique" id="voirPlus">Voir plus</a>';
            } ?>
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
            <?php if($nbAlbums > 12) {
                echo '<a href="allGroupe.php?id_groupe='.$id_groupe.'&type=album" id="voirPlus">Voir plus</a>';
            } ?>
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
<div id="bottomPage" class="sections_accueil"></div>
