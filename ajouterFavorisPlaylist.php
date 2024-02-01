<?php
    $id_playlist = $_GET['id'] ?? 1;
    $id_utilisateur = $_SESSION['user'].getIdUtilisateur(); 
    $data = new Data\DataBase();
    $userStatement = $data->insertFavorisPlaylist($id_playlist, $id_utilisateur);
?>