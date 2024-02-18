<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom_album = $_POST['nom_album'];
        $date_sortie = $_POST['date_sortie'];
        $date_sortie = date("Y-m-d", strtotime($date_sortie));
        $groupe = $_POST['groupe'];
        $image = $_POST['image'];
        require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
        $data = new Data\DataBase();
        $id_groupe = $data->getIdGroupe($groupe)['id_groupe'];
        if ($id_groupe){
            $data->creerAlbum($nom_album, $date_sortie, $id_groupe, $image);
            $id_album = $data->getIdAlbum($nom_album)['id_album'];
            header('Location: /Pages/Views/album.php?id='.$id_album);
        } else {
            echo "<strong>Le groupe n'existe pas</strong>";
        }
    } 
?>
<form action="creerAlbum.php" method="post" id ="Creer" class="boxCreation">
    <label for="nom_album">Nom de l'album:</label><br>
    <input type="text" id="nom_album" name="nom_album"><br>
    <label for="date_sortie">Date de sortie:</label><br>
    <input type="date" id="date_sortie" name="date_sortie"><br>
    <label for="groupe">Groupe:</label><br>
    <input type="text" id="groupe" name="groupe"><br>
    <label for="image">Image:</label><br>
    <input type="text" id="image" name="image"><br>
    <input type="submit" value="Submit">
</form>