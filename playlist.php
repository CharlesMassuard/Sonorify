
<?php 
    session_start();
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
    <link rel="stylesheet" href="./static/css/playlist.css">
    <script src="./static/js/playlist.js" defer></script>
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
            echo "Durée : " . $somme . " secondes";
            echo '<div id="note">';
            for ($i=0; $i < 5; $i++) { 
                echo '<a id="ajout_note" href="ajouterNotePlaylist.php?id='.$playlist['id_playlist'].'&note='.($i+1).'">';
                echo '<i class="material-icons">star</i>';
                echo '</a>';
            }
            echo '</div>';
            if ($_SESSION  && is_array($_SESSION) && $data->isFavorisPlaylist($id_playlist, $_SESSION['user']['id_utilisateur']) ?? false){
                echo '<a href="supprimerFavorisPlaylist.php?id='.$id_playlist.'">Supprimer des favoris</a>';
            } else {
                echo '<a href="ajouterFavorisPlaylist.php?id='.$id_playlist.'">Ajouter aux favoris</a>';
            }
            if ($_SESSION  && $playlist['id_auteur'] == $_SESSION['user']['id_utilisateur']){
                echo '<a href="supprimerPlaylist.php?id='.$id_playlist.'">Supprimer</a>';
            }
             ?></p>
        </div>
        <div id="musiques">
            <h2>Musiques</h2>
            <?php
            echo '<form action="ajouterMusiquePlaylist.php?id='.$id_playlist.'" method="post">';
            echo '<input id="barre_ajout" type="text" name="nom_musique" list="allMusiques">';
            echo '<input type="submit" value="Ajouter la Musique">';
            echo '</form>';
            echo '<datalist id="allMusiques">';
            foreach ($data->getMusiquesPlaylist($playlist['id_auteur']) as $musique) {
                echo '<option value="'.$musique['nom_musique'].'">';
            }
            echo '</datalist>';

            foreach ($musiques as $musique) {
                echo '<div id="musique">';
                $image = $data->getMusiquesAlbumsByPlaylist($playlist['id_playlist'])['image_album'] ?? 'default.jpg';
                echo '<img src="./ressources/images/'.$image.'">';
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
                echo '<a href="ajouter_favoris?id='.$musique['id_musique'].'">Ajouter aux favoris</a>';
                if ($_SESSION  && $playlist['id_auteur'] == $_SESSION['user']['id_utilisateur']){
                    echo '<a href="supprimerMusiquePlaylist.php?id='.$musique['id_musique'].'&id_playlist='.$id_playlist.'">Supprimer</a>';
                }
                echo '<p>Durée : '.$musique['duree'].'</p>';
                echo '</div>';
            }
            ?>
        </div>
    </main>
</body>
</html>