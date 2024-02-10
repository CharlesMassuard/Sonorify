<?php
declare(strict_types=1);
session_start();
if ($_SESSION['user'] == null) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
    header('Location: login.php');
}

require_once 'Classes/Data/DataBase.php';
$data = new Data\DataBase();

// Autoload
require 'Classes/Autoloader.php';
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
            foreach ($playlists as $playlist) {
                echo '<a href= "playlist.php?id='.$playlist['id_playlist'].'" id="Playlist">';
                $image = $data->getMusiquesAlbumsByPlaylist($playlist['id_playlist'])['image_album'] ?? 'default.jpg';
                echo '<img src="./ressources/images/'.$image.'">';
                echo '<h3>'.$playlist['nom_playlist'].'</h3>';
                echo '<p class="infos_supp">'.$playlist['description_playlist'].'</p>';
                $statut = $playlist['public'] ? "Publique" : "Privée";
                echo '<p class="infos_supp">'.$statut.'</p>';
                $note = $playlist['moyenne_note'] ?? "0";
                echo '<p class="infos_supp">Note : '.$note .'</p>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="playlists_favoris" class="sections_accueil">
            <h2>Vos Playlists favorites :</h2>
            <?php 
            $playlists = $data->getPlaylistsFavorisByUser($_SESSION['user']['id_utilisateur']);
            foreach ($playlists as $playlist) {
                echo '<a href= "playlist.php?id='.$playlist['id_playlist'].'">';
                $image = $data->getMusiquesAlbumsByPlaylist($playlist['id_playlist'])['image_album'] ?? 'default.jpg';
                echo '<img src="./ressources/images/'.$image.'">';
                echo '<h3>'.$playlist['nom_playlist'].'</h3>';
                echo '<p class="infos_supp">'.$playlist['description_playlist'].'</p>';
                echo '</a>';
            }
            ?>
        </div>
        <div id="musiques_favoris" class="sections_accueil">
            <h2>Vos Musiques favorites :</h2>
            <?php 
            $musiques = $data->getMusiquesFavorisByUser($_SESSION['user']['id_utilisateur']);
            foreach ($musiques as $musique) {
                echo '<a href= "musique.php?id='.$musique['id_musique'].'">';
                $image = $data->getMusiquesAlbumsByPlaylist($musique['id_musique'])['image_album'] ?? 'default.jpg';
                echo '<img src="./ressources/images/'.$image.'">';
                echo '<h3>'.$musique['nom_musique'].'</h3>';
                echo '<p class="infos_supp">'.$data->getNomGroupe($musique['id_groupe'])['nom_groupe'].'</p>';
                echo '</a>';
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
                echo '<img src="./ressources/images/'.$image.'">';
                echo '<h3>'.$groupe['nom_groupe'].'</h3>';
                echo '<p class="infos_supp">'.$groupe['description_groupe'].'</p>';
                echo '</a>';
            }
            ?>
        </div>