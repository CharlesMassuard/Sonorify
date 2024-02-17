<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_genre = $_GET['id'] ?? 1;
    require_once '../../Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    require 'Classes/Autoloader.php';
    Autoloader::register();
    $genre = $data->getGenresById($id_genre);
    $musiques = $data->getMusiquesByGenre($id_genre);
    $musiques = Factory::createMusiques($musiques);
    echo '<h1>'.$genre['nom_genre'].'</h1>';
    echo "<div class='sections_accueil'>";
    echo '<h2>Genres similaires :</h2>';
    $genres = $data->getGenresSimilaire($id_genre);
    $genres = Factory::createGenres($genres);
    foreach ($genres as $genre) {
        $genre->render();
    }
    echo "</div>";
    echo "<div>";
    echo '<h2>Musiques :</h2>';
    foreach ($musiques as $musique) {
        $musique->render();
    }
    echo "</div>";
?>
