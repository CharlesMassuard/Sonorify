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
    $musiques = $data->getMusiquesByGroupe($id_groupe);
    $musiques = Factory::createMusiques($musiques);
    $albums = $data->getAlbumsByGroupe($id_groupe);
    $albums = Factory::createAlbums($albums);
    $artistes = $data->getArtistesByGroupe($id_groupe);
    $artistes = Factory::createArtistes($artistes);
    echo '<h1>'.$groupe['nom_groupe'].'</h1>';
    echo '<div>';
    echo '<img src="./static/img/'.$groupe['image_groupe'].'">';
    echo '<p>'.$groupe['description_groupe'].'</p>';
    echo '</div>';
    echo '<h2>Artistes</h2>';
    echo '<div id="artistes" class="sections_accueil">';
    foreach ($artistes as $artiste) {
        $artiste->render();
    }
    echo '</div>';
    echo '<h2>Albums</h2>';
    echo '<div id="albums" class="sections_accueil">';
    foreach ($albums as $album) {
        $album->render();
    }
    echo '<h2>Musiques</h2>';
    echo '<div id="musiques" class="sections_accueil">';
    foreach ($musiques as $musique) {
        $musique->render();
    }
    echo '</div>';
?>
