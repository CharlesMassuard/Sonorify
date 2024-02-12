<?php
    require_once 'Classes/Factory.php';
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();

    require 'Classes/Autoloader.php';
    Autoloader::register();
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['page'] = 'accueil.php';
?>
<div id="titre">
    <?php
        if (!isset($_SESSION['user'])) {
            echo '<h1> Bienvenue </h1>';
        } else {
            echo '<h1> Bienvenue '.$_SESSION['user']['prenom_utilisateur'].'</h1>';
        }
    ?>
</div>
<?php
    if (isset($_SESSION['user']) && count($data->getMusiqueRecemmentEcoutee())>=4) {
        $musiques = $data->getMusiqueRecemmentEcoutee();
        if(count($musiques) == 0) {
            $musiques = $data->getMusiqueRecente();
            echo '<h2>Musiques</h2>';
        } else {
            echo '<h2>Musiques Recemment Ecoutées</h2>';
        }
    } else {
        echo '<h2>Musiques</h2>';
        $musiques = $data->getMusiqueRecente();       
    }
    $musiques = Factory::createMusiques($musiques);
    echo '<div id="musiques" class="sections_accueil">';
    foreach ($musiques as $musique) {
        $musique->render();
    }
    echo '</div>';
?>
<h2>Playlists</h2>
<div id="playlist" class="sections_accueil">
    <?php 
    $playlists = $data->getPlaylistsTrieesParNote();
    $playlists = Factory::createPlaylists($playlists);
    foreach ($playlists as $playlist) {
        $playlist->render();
    }
    ?>
</div>
<div class="sections">
<h2>Albums</h2>
<a href="creerAlbum.php">Créer</a>
<div id="albums" class="sections_accueil">
    <?php 
    $albums = $data->getAlbumsTrieesParNote();
    $albums = Factory::createAlbums($albums);
    foreach ($albums as $album) {
        $album->render();
    }
    ?>
</div>
</div>
<div class="sections">
<h2>Genres</h2>
<a href="creerGenre.php">Créer</a>
<div id="genres" class="sections_accueil">
    <?php 
    $genres = $data->getGenres();
    $genres = Factory::createGenres($genres);
    foreach ($genres as $genre) {
        $genre->render();
    } 
    ?>
</div>
</div>
<div class="sections">
<h2>Groupes et Artistes</h2>
<a href="creerMusique">Créer</a>
<div id="groupes" class="sections_accueil">
    <?php 
    $groupes = $data->getGroupes();
    $groupes = Factory::createGroupes($groupes);
    foreach ($groupes as $groupe) {
        $groupe->render();
    }
    ?>
</div>
</div>
<div id="bottomPage" class="sections_accueil"></div>