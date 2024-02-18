<?php
declare(strict_types=1);
session_start();
if ($_SESSION['user'] == null) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
}

require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php';
$data = new Data\DataBase();

// Autoload
require dirname(__FILE__) . '/../../Classes/Autoloader.php';
Autoloader::register();
?>
<head>
    <link rel="stylesheet" href="./static/css/profil.css">
</head>
<body>
    <div id="profil">
        <h2>Profil</h2>
        <div id="infos">
            <p><?php echo "Nom : " . $_SESSION['user']['nom_utilisateur'] ?></p>
            <p><?php echo "Prénom : " . $_SESSION['user']['prenom_utilisateur'] ?></p>
            <p><?php echo "Email : " . $_SESSION['user']['email_utilisateur'] ?></p>
            <p><?php echo "Date de naissance : " . $_SESSION['user']['ddn_utilisateur'] ?></p>
            <a href="modifierProfil.php" id="modifProfil">Modifier le profil</a>
            <a href="deconnexion.php" id="modifProfil">Deconnexion</a>
        </div>
    </div>
    <div id="playlists" class="sections_accueil">
        <?php
            $playlists = $data->getPlaylistsByUser($_SESSION['user']['id_utilisateur']);
            if (count($playlists) > 0) {
                echo '<h2>Vos Playlists :</h2>';
                $playlists = Factory::createPlaylists($playlists);
                foreach ($playlists as $playlist) {
                    $playlist->renderPersonnal();
                }
            }
        ?>  
    </div>
    <div id="playlists_favoris" class="sections_accueil">
        <?php 
            $playlists = $data->getPlaylistsFavorisByUser($_SESSION['user']['id_utilisateur']);
            if (count($playlists) > 0) {
                echo '<h2>Vos Playlists favorites :</h2>';
                $playlists = Factory::createPlaylists($playlists);
                foreach ($playlists as $playlist) {
                    $playlist->renderPersonnal();
                }
            }
        ?>
    </div>
    <div id="musiques_favoris" class="sections_accueil">
        <?php 
            $musiques = $data->getMusiquesFavorisByUser($_SESSION['user']['id_utilisateur']);
            if (count($musiques) > 0) {
                echo '<h2>Vos Musiques favorites :</h2>';
                $musiques = Factory::createMusiques($musiques);
                foreach ($musiques as $musique) {
                    $musique->render();
                }
            }
        ?>
    </div>
    <div id="albums" class="sections_accueil">
        <?php 
            $albums = $data->getAlbumsFavorisByUser($_SESSION['user']['id_utilisateur']);
            if (count($albums) > 0) {
                echo '<h2>Vos Albums :</h2>';
                $albums = Factory::createAlbums($albums);
                foreach ($albums as $album) {
                    $album->render();
                }
            }

        ?>
    </div>
    <div id="groupes_favoris" class="sections_accueil">
        <?php
            $groupes = $data->getGroupesFavorisByUser($_SESSION['user']['id_utilisateur']);
            if (count($groupes) > 0) {
                echo '<h2>Vos Groupes :</h2>';
                $groupes = Factory::createGroupes($groupes);
                foreach ($groupes as $groupe) {
                    $groupe->render();
                }
            }
        ?>
    </div>
<body>