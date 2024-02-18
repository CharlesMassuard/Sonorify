<?php
    require_once dirname(__FILE__) . '/../../Classes/Factory.php';
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php';
    $data = new Data\DataBase();

    require_once dirname(__FILE__) . '/../../Classes/Autoloader.php';
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
<div id="titleSectionsAccueil">
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

        if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 2) {
            echo '<a href="/Pages/Views/creerMusique.php" id="Ajouter">Créer une musique</a>';
        }
    ?>
</div>
<?php
    $musiques = Factory::createMusiques($musiques);
    echo '<div id="musiques" class="sections_accueil">';
    foreach ($musiques as $musique) {
        $musique->render();
    }
    echo '</div>';
?>
<div id="titleSectionsAccueil">
<h2>Playlists</h2>

<?php if(isset($_SESSION['user'])){
    echo '<a href="/Pages/Views/creerPlaylist.php" id="Ajouter">Créer une playlist</a>';
}
?>
</div>
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
<div id="titleSectionsAccueil">
<h2>Albums</h2>

<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 2){
   echo '<a href="/Pages/Views/creerAlbum.php" id="Ajouter">Créer un album</a>';
}
?>
</div>
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
<div id="titleSectionsAccueil">
<h2>Genres</h2>
<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 2){
   echo '<a href="/Pages/Views/creerGenre.php" id="Ajouter">Créer un genre</a>';
}
?>
</div>
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
<div id="titleSectionsAccueil">
<h2>Groupes et Artistes</h2>
<?php 
if (isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 2){
   echo '<a href="/Pages/Views/creerGroupe.php" id="Ajouter">Créer un groupe/artiste</a>';
}
?>
</div>
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