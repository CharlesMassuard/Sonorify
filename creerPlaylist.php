<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom_playlist = $_POST['nom_playlist'];
        $description = $_POST['description'];
        $public = $_POST['public'];
        if ($public == "on"){
            $public = 1;
        } else {
            $public = 0;
        }
        $user = $_SESSION['user'];
        require_once 'Classes/Data/DataBase.php'; 
        $db = new Data\Database();
        $db->creerPlaylist($nom_playlist, $description, $public, $user['id_utilisateur']);
        $id_playlist = $db->getPlaylistsByName($nom_playlist)[0]['id_playlist'];
        if ($id_playlist){
            header('Location: accueil.php');
        } else {
            echo "<strong>La playlist n'a pas été créée</strong>";
        }
    } 
?>
<header>
    <link rel="stylesheet" href="./static/css/creationPlaylist.css">
</header>
<form id="creationPlaylist" action="creerPlaylist.php" method="post">
    <h2>Créer une playlist</h2>
    <label for="nom_playlist">Nom de la Playlist:</label><br>
    <input type="text" id="nom_playlist" name="nom_playlist"><br>
    <label for="description">Description:</label><br>
    <input type="text" id="description" name="description"><br>
    <label for="public">Publique ?</label><br>
    <input type="checkbox" id="public" name="public"><br>
    <input type="submit" value="Créer la playlist">
</form>