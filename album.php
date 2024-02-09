
<?php 
    session_start();
    $id_album = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $album = $data->getAlbum($id_album);
    $musiques = $data->getMusiquesAlbum($id_album);
?>
<!doctype>
<html>
<head>
    <title>PHP'oSong</title>
    <link rel="stylesheet" href="./static/css/header.css">
    <link rel="stylesheet" href="./static/css/playlist.css">
    <script src="./static/js/playlist.js" defer></script>
</head>
<body>
    <?php include 'aside.php'; ?>
    <?php include 'bigPlayer.php'; ?>
    <?php include 'player.php'; ?>
    <main>
        <?php include 'header.php'; ?>
        <h1>Albums</h1>
        <div id="album">
            <h2><?php echo "Nom : " . $album['titre'] ?></h2>
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
            echo "Durée : " . $dureeTotale."</p>";
            echo '<p>Sortie : ' . $album['dateSortie'] . '</p>';
            echo '<a href="groupe.php?id='.$album['id_groupe'].'">'.$data->getGroupe($album['id_groupe'])['nom_groupe'].'</a>';
            echo '<div id="note">';
            for ($i=0; $i < 5; $i++) { 
                echo '<a id="ajout_note" href="ajouterNoteAlbum.php?id='.$album['id_album'].'&note='.($i+1).'">';
                echo '<i class="material-icons">star</i>';
                echo '</a>';
            }
            echo '</div>';
             ?>

        </div>
        <div id="musiques">
            <h2>Musiques</h2>
            <?php 
            
            foreach ($musiques as $musique) {
                echo '<div id="musique">';
                echo '<img src="./ressources/images/'.$album['image_album'].'">';
                echo '<a href= "">';
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
                echo '<p>Durée : '.$musique['duree'].'</p>';
                echo '</div>';
            }
            ?>
    </main>
</body>
</html>