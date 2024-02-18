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
        <div id="profil">
            <h2>Profil</h2>
            <p><?php echo "Nom : " . $_SESSION['user']['nom_utilisateur'] ?></p>
            <p><?php echo "Prénom : " . $_SESSION['user']['prenom_utilisateur'] ?></p>
            <p><?php echo "Email : " . $_SESSION['user']['email_utilisateur'] ?></p>
            <p><?php echo "Date de naissance : " . $_SESSION['user']['ddn_utilisateur'] ?></p>
            <a href="modifierProfil.php">Modifier le profil</a>
        </div>
        <div id="playlists" class="sections_accueil">
            <h2>Vos Playlists :</h2>
            <?php 
            $playlists = $data->getPlaylistsByUser($_SESSION['user']['id_utilisateur']);
            $playlists = Factory::createPlaylists($playlists);
            foreach ($playlists as $playlist) {
                $playlist->renderPersonnal();
            }
            ?>
        </div>
        <div id="playlists_favoris" class="sections_accueil">
            <h2>Vos Playlists favorites :</h2>
            <?php 
            $playlists = $data->getPlaylistsFavorisByUser($_SESSION['user']['id_utilisateur']);
            $playlists = Factory::createPlaylists($playlists);
            foreach ($playlists as $playlist) {
                $playlist->render();
            }
            ?>
        </div>
        <div id="musiques_favoris" class="sections_accueil">
            <h2>Vos Musiques favorites :</h2>
            <?php 
            $musiques = $data->getMusiquesFavorisByUser($_SESSION['user']['id_utilisateur']);
            $musiques = Factory::createMusiques($musiques);
            foreach ($musiques as $musique) {
                $musique->render();
            }
            ?>
        </div>
        <div id="albums" class="sections_accueil">
            <h2>Vos Albums favoris :</h2>
            <?php 
            $albums = $data->getAlbumsFavorisByUser($_SESSION['user']['id_utilisateur']);
            $albums = Factory::createAlbums($albums);
            foreach ($albums as $album) {
                $album->render();
            }
            ?>
        </div>
        <div id="groupes_favoris" class="sections_accueil">
            <h2>Vos Groupes favoris :</h2>
            <?php 
            $groupes = $data->getGroupesFavorisByUser($_SESSION['user']['id_utilisateur']);
            foreach ($groupes as $groupe) {
                echo '<a href= "groupe.php?id='.$groupe['id_groupe'].'">';
                $image = $data->getAlbumsByGroupe($groupe['id_groupe'])['image_album'] ?? 'default.jpg';
                echo '<img src="/static/img/'.$image.'">';
                echo '<h3>'.$groupe['nom_groupe'].'</h3>';
                echo '<p class="infos_supp">'.$groupe['description_groupe'].'</p>';
                echo '</a>';
            }
            ?>
        </div>