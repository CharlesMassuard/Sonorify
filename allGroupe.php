<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_groupe = $_GET['id_groupe'] ?? 1;
    $type = $_GET['type'] ?? 'musique';
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    require 'Classes/Autoloader.php';
    Autoloader::register();
    $groupe = $data->getGroupeById($id_groupe);
    if($type == 'musique') {
        $res = $data->getMusiquesByGroupe($id_groupe);
        $res = Factory::createMusiques($res);
    } else {
        $res = $data->getAlbumsByGroupe($id_groupe);
        $res = Factory::createAlbums($res);
    }
?>

<header>
    <link rel="stylesheet" href="./static/css/allGroupe.css">
</header>
<div id="elementsGroupe">
<a href="groupe.php?id=<?php echo $id_groupe; ?>" id="retourArriere"><p>Retour</p></a>
    <?php
        foreach ($res as $resultat) {
            $resultat->render();
        }
    ?>
</div>
<div id="bottomPage" class="sections_accueil"></div>