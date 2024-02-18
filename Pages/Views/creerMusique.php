<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom_musique = $_POST['nom_musique'];
        $duree = $_POST['duree'];
        $nom_groupe = $_POST['nom_groupe'];
        $nom_album = $_POST['nom_album'];
        $nom_genre = $_POST['nom_genre'];
        $url = $_POST['url'];
        $user = $_SESSION['user'];
        require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
        $db = new Data\Database();
        $id_groupe = $db->getGroupesByName($nom_groupe)[0]['id_groupe'];
        $id_album = $db->getAlbumsByName($nom_album)[0]['id_album'];
        $id_genre = $db->getGenresByName($nom_genre)[0]['id_genre'];
        $db->creerMusique($nom_musique, $duree, $id_groupe, $id_album, $id_genre, $url);
        $id_musique = $db->getMusiquesByName($nom_musique)[0]['id_musique'];
        if ($id_musique){
            header('Location: /Pages/Views/accueil.php');
        } else {
            echo "<strong>La musique n'a pas été créée</strong>";
        }
    } 
?>
<form action="creerMusique.php" method="post" id ="Creer">
    <label for="nom_musique">Nom de Musique</label>
    <input type="text" id="nom_musique" name="nom_musique" required>
    <label for="duree">Durée</label>
    <input type="time" id="duree" name="duree" required>
    <label for="nom_groupe">Nom de Groupe</label>
    <input type="text" id="nom_groupe" name="nom_groupe" required>
    <label for="nom_album">Nom d'Album</label>
    <input type="text" id="nom_album" name="nom_album" required>
    <label for="nom_genre">Nom de Genre</label>
    <input type="text" id="nom_genre" name="nom_genre" required>
    <label for="url">URL</label>
    <input type="text" id="url" name="url" required>
    <input type="submit" value="Créer">
</form>