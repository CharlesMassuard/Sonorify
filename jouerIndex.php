<?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id_musique = $_GET['id'] ?? 1;
        $index = $_GET['index'] ?? 0;
        require_once 'Classes/Data/DataBase.php'; 
        $data = new Data\DataBase();
        $render_musique = [];
        $render_musique['id_musique'] = $id_musique;
        $render_musique['index'] = $index;
        print_r(json_encode($render_musique));
        if (isset($_SESSION['user'])) {
            $data->insertEcoute($id_musique, $_SESSION['user']['id_utilisateur']);
        } 
    ?>