
<?php 
    session_start();
    $id_album = $_GET['id'] ?? 1;
    require_once 'Data/DataBase.php';
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
                $somme += $musique['duree'];
            }
            echo "Durée : " . $somme . " secondes</p>";
            echo '<p>Sortie : ' . $album['dateSortie'] . '</p>';
            echo 'Créer par : <a href="groupe.php?id='.$album['id_groupe'].'">'.$data->getGroupe($album['id_groupe'])['nom_groupe'].'</a>';
            echo '<div id="note">';
            for ($i=0; $i < 5; $i++) { 
                echo '<a id="ajout_note" href="ajouterNoteAlbum.php?id='.$playlist['id_playlist'].'&note='.($i+1).'">';
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