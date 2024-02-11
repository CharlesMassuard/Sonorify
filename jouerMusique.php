    <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id_musique = $_GET['id'] ?? 1;
        require_once 'Classes/Data/DataBase.php'; 
        $data = new Data\DataBase();
        $musiqueDetails = $data->getMusique($id_musique);
        $nomMusique = $musiqueDetails['nom_musique'];
        $album = $data->getAlbumByMusique($id_musique);
        $nomAlbum = $album['titre'];
        $cover = $album['image_album'];
        $nomGroupe = $data->getNomGroupe($musiqueDetails['id_groupe'])['nom_groupe'];
        $urlMusique = $musiqueDetails['url_musique'];
        $render_musique = [];
        $render_musique['id_musique'] = $id_musique;
        $render_musique['nom_musique'] = $nomMusique;
        $render_musique['cover'] = $cover;
        $render_musique['nom_groupe'] = $nomGroupe;
        $render_musique['nom_album'] = $nomAlbum;
        $render_musique['urlMusique'] = $urlMusique;
        print_r(json_encode($render_musique));
        if (isset($_SESSION['user'])) {
            $data->insertEcoute($id_musique, $_SESSION['user']['id_utilisateur']);
        } 
        // echo "<script type='module' src='static/js/player.js'></script>";
        // echo "<script type='module'>";
        // echo "import { lireUneMusique } from './static/js/player.js';";
        // echo "import { playPlaylist } from './static/js/player.js';";
        // echo "lireUneMusique('$id_musique', '$nomMusique', '$cover', '$nomGroupe', '$nomAlbum', '$urlMusique');";
        // echo "</script>";
    ?>