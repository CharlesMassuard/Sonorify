<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_genre = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    require 'Classes/Autoloader.php';
    Autoloader::register();
    $genre = $data->getGenresById($id_genre);
    $musiques = $data->getMusiquesByGenre($id_genre);
    $musiques = Factory::createMusiques($musiques);
    echo '<h1>'.$genre['nom_genre'].'</h1>';
    foreach ($musiques as $musique) {
        $musique->render();
    }
?>