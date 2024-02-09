
<?php 
    session_start();
    $id_album = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $album = $data->getAlbum($id_album);
    $musiques = $data->getMusiquesAlbum($id_album);
    $nbrMusiques = count($musiques);
    $groupe = $data->getAlbumsArtistesByIdAlbum($album['id_album']);
?>
<!doctype>
<html>
<head>
    <title><?php echo $groupe['nom_groupe']?> - <?php echo $album['titre']?></title>
    <link rel="icon" type="image/x-icon" href="./ressources/images/logo.png">
    <link rel="stylesheet" href="./static/css/playlist.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./static/js/playlist.js" defer></script>
</head>
<body>
    <?php include 'aside.php'; ?>
    <?php include 'player.php'; ?>
    <main>
        <?php include 'header.php'; ?>
        <div id="playlistAlbum">
            <div id="playlist">
                <img id="imgPlaylistAlbum" src="./ressources/images/<?php echo $album["image_album"]?>">
                <div id="playlistDetails">
                    <h2><?php echo $album['titre'] ?></h2>
                    <?php  
                        $dateSortie = substr($album["dateSortie"], -4);
                        echo '<p> Album  • '.$groupe['nom_groupe'].' • '.$dateSortie.'</p>';
                        ?>
                    <p><?php 
                    $somme = 0;
                    foreach ($musiques as $musique) {
                        // Divisez la durée en minutes et secondes
                        list($minutes, $secondes) = explode(':', $musique['duree']);
                        
                        // Convertissez la durée en secondes et ajoutez-la à $somme
                        $somme += $minutes * 60 + $secondes;
                    }
                    
                    // Convertissez $somme en un format de temps approprié
                    $heures = floor($somme / 3600);
                    $minutes = floor(($somme % 3600) / 60);
                    $secondes = $somme % 60;
                    
                    // Formattez le temps en une chaîne de caractères
                    if($heures == 0){
                        $dureeTotale = sprintf("%02dm %02ds", $minutes, $secondes);
                    } else {
                        $dureeTotale = sprintf("%02dh %02dm %02ds", $heures, $minutes, $secondes);
                    }
                    if($heures == 0){
                        $dureeTotale = sprintf("%02dm %02ds", $minutes, $secondes);
                    } else {
                        $dureeTotale = sprintf("%02dh %02dm %02ds", $heures, $minutes, $secondes);
                    }
                    if($nbrMusiques == 1){
                        echo $nbrMusiques." Titre • ".$dureeTotale . "</p>";
                    } else {
                        echo $nbrMusiques." Titres • ".$dureeTotale . "</p>";
                    }
                    echo '<div id="note">';
                    for ($i=0; $i < 5; $i++) { 
                        echo '<a id="ajout_note" href="ajouterNoteAlbum.php?id='.$album['id_album'].'&note='.($i+1).'">';
                        echo '<i class="material-icons">star</i>';
                        echo '</a>';
                    }
                    echo '</div>';
                    echo '<button id="jouerAlbum" title="Lire l\'album"><i class="material-icons">play_arrow</i></button>';
                    echo '<button id="jouerAlbum" title="Lire l\'album aléatoirement"><i class="material-icons">shuffle</i></button>';
                    if ($_SESSION  && is_array($_SESSION) && $data->isFavorisAlbum($id_album, $_SESSION['user']['id_utilisateur']) ?? false){
                        echo '<button id="favorisAlbum" title="Supprimer des favoris"><i class="material-icons">favorite</i></button>';
                    } else {
                        echo '<button id="favorisAlbum" title="Ajouter aux favoris"><i class="material-icons">favorite</i></button>';
                    }
                    ?>
                </div>
            </div>
            <div id="musiquesAlbum">
                <?php 
                
                foreach ($musiques as $musique) {
                    echo '<div id="musique">';
                    echo '<img id="imgMusiqueAlbum" src="./ressources/images/'.$album['image_album'].'">';
                    echo "<a href= 'jouerMusique.php?id_musique={$musique['id_musique']}'>";
                    echo '<h2>'.$musique['nom_musique'].'</h2>';
                    echo '</a>';
                    echo '<a href="groupe.php?id='.$musique['id_groupe'].'">'.$data->getGroupe($musique['id_groupe'])['nom_groupe'].'</a>';
                    echo '<div id="note">';
                    for ($i=0; $i < 5; $i++) { 
                        echo '<a id="ajout_note" href="ajouterNotePlaylist.php?id='.$musique['id_musique'].'&note='.($i+1).'">';
                        echo '<i class="material-icons">star</i>';
                        echo '</a>';
                    }
                    echo '</div>';
                    echo '<button id="prevButton" title="Précédent"><i class="material-icons">favorite</i></button>';
                    echo '<p>'.$musique['duree'].'</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div id="bottomPage" class="sections_accueil"></div>
    </main>
</body>
</html>