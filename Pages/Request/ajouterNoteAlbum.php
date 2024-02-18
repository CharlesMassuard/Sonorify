<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    } else {
        $id_album = $_GET['id'] ?? 1;
        $note = $_GET['note'] ?? 1;
        $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
        require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
        $data = new Data\DataBase();
        $userStatement = $data->insertNoteAlbum($id_album, $id_utilisateur, $note);
        header('Location: album.php?id='.$id_album);
    }
?>