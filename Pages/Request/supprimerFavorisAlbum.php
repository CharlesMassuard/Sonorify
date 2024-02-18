<?php
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    }
    $id_album = $_GET['id'] ?? 1;
    $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $userStatement = $data->deleteFavorisAlbum($id_album, $id_utilisateur);
    header('Location: album.php?id='.$id_album);
?>