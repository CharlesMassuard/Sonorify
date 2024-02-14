<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    }
    $id_album = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $nom_musique = $_POST['nom_musique'] ?? 'AA';
    $musique = $data->getMusiqueByName($nom_musique);
    $id_musique = $musique['id_musique'];
    $userStatement = $data->insertMusiqueAlbum($id_musique, $id_album);
    header('Location: album.php?id='.$id_album);
?>