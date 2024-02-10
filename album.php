
<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_album = $_GET['id'] ?? 1;
    $_SESSION['page'] = 'album.php?id='.$id_album;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $album = $data->getAlbum($id_album);
    $musiques = $data->getMusiquesAlbum($id_album);
    $nbrMusiques = count($musiques);
    $groupe = $data->getAlbumsArtistesByIdAlbum($album['id_album']);
?>

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
                    echo '<div id="inputPlaylistAlbum">';
                    echo '<form id="PlayAlbum" action="jouerAlbum.php?id_album='.$album["id_album"].'&aleatoire=false" method="post">';
                    echo '<input type="submit" id="jouerAlbum" name="jouerAlbum" style="display: none;">';
                    echo '<label for="jouerAlbum"  title="Lire l\'album"><i class="material-icons">play_arrow</i></label>';
                    echo '</form>';

                    echo '<form id="PlayAlbum" action="jouerAlbum.php?id_album='.$album["id_album"].'&aleatoire=true" method="post">';
                    echo '<input type="submit" id="jouerAlbumAleatoire" name="jouerAlbumAleatoire" style="display: none;">';
                    echo '<label for="jouerAlbumAleatoire"  title="Lire l\'album aléatoirement"><i class="material-icons">shuffle</i></label>';
                    echo '</form>';
                    if ($_SESSION  && is_array($_SESSION) && $data->isFavorisAlbum($id_album, $_SESSION['user']['id_utilisateur']) ?? false){
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
            <div id="musiquesAlbum">
                <?php 
                
                foreach ($musiques as $musique) {
                    echo '<div id="musique">';
                    echo '<img id="imgMusiqueAlbum" src="./ressources/images/'.$album['image_album'].'">';
                    echo '<a id="PlayAlbumMusique" href= "jouerAlbum.php?id_album='.$album["id_album"].'&aleatoire=false&musiqueStart='.$musique["id_musique"].'" method="post">';
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
                    echo '<form action="votre_page.php" method="post">';
                    echo '<input type="submit" id="favMusique" name="addFavoriteMusique" style="display: none;">';
                    echo '<label for="addFavoriteMusique"  title="Ajouter aux favoris"><i class="material-icons">favorite</i></label>';
                    echo '</form>';
                    echo '<p>'.$musique['duree'].'</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div id="bottomPage" class="sections_accueil"></div>