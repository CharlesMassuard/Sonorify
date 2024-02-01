
<?php 
    $id_playlist = $_GET['id'] ?? 1;
    require_once 'Data/DataBase.php';
    $data = new Data\DataBase();
    $playlist = $data->getPlaylist($id_playlist);
    $musiques = $data->getMusiquesPlaylist($id_playlist);
?>
<!doctype>
<html>
<head>
    <title>PHP'oSong</title>
    <link rel="stylesheet" href="./static/css/header.css">
    <!-- <link rel="stylesheet" href="./static/css/playlist.css"> -->
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Playlist</h1>
        <div id="playlist">
            <h2><?php echo "Nom : " . $playlist['nom_playlist'] ?></h2>
            <p><?php echo $playlist['description_playlist'] ?></p>
            <p>
            <?php 
                if ($playlist['public']){
                    echo "Publique";
                } else {
                    echo "Privée";
                } ?></p>
            <p><?php echo "Créé par ". $data->getUtilisateur($playlist['id_auteur'])['nom_utilisateur'] ?></p>
            <p><?php 
            $somme = 0;
            foreach ($musiques as $musique) {
                $somme += $musique['duree'];
            }
            echo "Durée : " . $somme . " secondes"
             ?></p>
        </div>
        <div id="musiques">
            <h2>Musiques</h2>
            <?php

            echo '<input type="text" list="allMusiques">';
            echo '<datalist id="allMusiques">';
            foreach ($data->getMusiquesPlaylist($playlist['id_auteur']) as $musique) {
                echo '<option value="'.$musique['nom_musique'].'">';
            }
            echo '</datalist>';

            foreach ($musiques as $musique) {
                echo '<a href= "">';
                echo '<h2>'.$musique['nom_musique'].'</h2>';
                echo '<p>'.$musique['duree'].'</p>';
                echo '<a href="groupe.php?id='.$musique['id_groupe'].'">'.$data->getGroupe($musique['id_groupe'])['nom_groupe'].'</a>';
                echo '<a href="ajouter_favoris?id='.$musique['id_musique'].'">Ajouter aux favoris</a>';
                if ($playlist['id_auteur'] == $_SESSION['id_utilisateur']){
                    echo '<a href="supprimer_musique_playlist.php?id='.$musique['id_musique'].'&id_playlist='.$id_playlist.'">Supprimer</a>';
                }
                echo '</a>';
            }
            ?>
        </div>
    </main>
</body>
</html>