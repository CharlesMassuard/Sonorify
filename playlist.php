
<?php 
    session_start();
    $id_playlist = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $playlist = $data->getPlaylist($id_playlist);
    $musiques = $data->getMusiquesPlaylist($id_playlist);
    $nbrMusiques = count($musiques);
?>
<html>
<head>
    <title>Sonorify - <?php echo $playlist['nom_playlist']?></title>
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
                <?php $image = $data->getMusiquesAlbumsByPlaylist($playlist['id_playlist'])['image_album'] ?? 'default.jpg'; ?>
                <img id="imgPlaylistAlbum" src="./ressources/images/<?php echo $image; ?>">
                <div id="playlistDetails">
                    <h1><?php echo $playlist['nom_playlist']; ?></h1>
                    <?php 
                        $status = ($playlist['public'] ? "Publique" : "Privée");
                        $auteur =  $data->getUtilisateur($playlist['id_auteur'])['nom_utilisateur']; 
                        echo '<p>'.$status.' • '.$auteur.'</p>';
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
                        if($nbrMusiques == 1){
                            echo $nbrMusiques." Titre • ".$dureeTotale . "</p>";
                        } else {
                            echo $nbrMusiques." Titres • ".$dureeTotale . "</p>";
                        }
                        echo '<div id="note">';
                        for ($i=0; $i < 5; $i++) { 
                            echo '<a id="ajout_note" href="ajouterNotePlaylist.php?id='.$playlist['id_playlist'].'&note='.($i+1).'">';
                            echo '<i class="material-icons">star</i>';
                            echo '</a>';
                        }
                        echo '</div>';
                        echo '<div id="inputPlaylistAlbum">';
                        echo '<form action="votre_page.php" method="post">';
                        echo '<input type="submit" id="jouerAlbum" name="jouerAlbum" style="display: none;">';
                        echo '<label for="jouerAlbum"  title="Lire la playlist"><i class="material-icons">play_arrow</i></label>';
                        echo '</form>';

                        echo '<form action="votre_page.php" method="post">';
                        echo '<input type="submit" id="jouerAlbumAleatoire" name="jouerAlbumAleatoire" style="display: none;">';
                        echo '<label for="jouerAlbumAleatoire"  title="Lire la playlist aléatoirement"><i class="material-icons">shuffle</i></label>';
                        echo '</form>';
                        if ($_SESSION  && is_array($_SESSION) && $data->isFavorisPlaylist($id_playlist, $_SESSION['user']['id_utilisateur']) ?? false){
                            echo '<form action="votre_page.php" method="post">';
                            echo '<input type="submit" id="favAlbum" name="deleteFavoriteAlbum" style="display: none;">';
                            echo '<label for="deleteFavoriteAlbum"  title="Supprimer des favoris"><i class="material-icons">favorite</i></label>';
                            echo '</form>';
                        } else {
                            echo '<form action="votre_page.php" method="post">';
                            echo '<input type="submit" id="favAlbum" name="addFavoriteAlbum" style="display: none;">';
                            echo '<label for="addFavoriteAlbum"  title="Ajouter aux favoris"><i class="material-icons">favorite</i></label>';
                            echo '</form>';
                        }
                    echo '</div>';
                        ?>
                        
                    </div>
                </div>
            </div>
            <div id="musiquesPlaylist">
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
                    echo '<img id="imgMusiqueAlbum" src="./ressources/images/'.$image.'">';
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
                    echo '<a href="ajouter_favoris?id='.$musique['id_musique'].'">Ajouter aux favoris</a>';
                    if ($_SESSION  && $playlist['id_auteur'] == $_SESSION['user']['id_utilisateur']){
                        echo '<a href="supprimerMusiquePlaylist.php?id='.$musique['id_musique'].'&id_playlist='.$id_playlist.'">Supprimer</a>';
                    }
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