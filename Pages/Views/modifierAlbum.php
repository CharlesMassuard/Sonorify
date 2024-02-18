<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }
    $id_album = $_GET['id'] ?? 1;
    $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $album = $data->getAlbum($id_album);
    $groupe = $data->getGroupe($album['id_groupe']);
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom_album = $_POST['nom_album'];
        $date_album = $_POST['date_album'];
        $image_album = $_POST['image_album'];
        $groupe_album = $_POST['groupe_album'];
        $id_groupe = $data->getGroupesByName($groupe_album)[0]['id_groupe'];
        $data->updateAlbum($id_album, $nom_album, $date_album, $id_groupe, $image_album);
        header('Location: /Pages/Views/album.php?id='.$id_album);
    }
?>

<form id="Modifier" method="post" action="/Pages/Views/modifierAlbum.php?id=<?php echo $id_album ?>">
    <input type="hidden" name="id_album" value="<?php echo $id_album ?>">
    <label for="nom_album">Nom de l'album</label>
    <input type="text" name="nom_album" placeholder="Nom de l'album" value="<?php echo $album['titre'] ?>">
    <label for="date_album">Date de sortie</label>
    <input type="text" name="date_album" placeholder="Date de sortie" value="<?php echo $album['dateSortie'] ?>">
    <label for="image_album">Image de l'album</label>
    <input type="text" name="image_album" placeholder="Image de l'album" value="<?php echo $album['image_album'] ?>">
    <label for="groupe_album">Groupe de l'album</label>
    <input type="text" name="groupe_album" placeholder="Groupe de l'album" value="<?php echo $groupe['nom_groupe'] ?>">
    <input type="submit" value="Modifier">
</form>