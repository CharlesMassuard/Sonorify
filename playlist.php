
<?php 
    session_start();
    $_SESSION['page'] = 'playlist.php';
    $id_playlist = $_GET['id'] ?? 1;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $playlist = $data->getPlaylist($id_playlist);
    $musiques = $data->getMusiquesPlaylist($id_playlist);
    $nbrMusiques = count($musiques);
?>
        <div id="playlistAlbum">
            <div id="playlist">
                <?php $image = $data->getMusiquesAlbumsByPlaylist($playlist['id_playlist'])['image_album'] ?? 'default.jpg'; ?>
                <img id="imgPlaylistAlbum" src="./ressources/images/<?php echo $image; ?>">
                <div id="playlistDetails">
                    <h1><?php echo $playlist['nom_playlist']; ?></h1>
                    <?php 
                        $status = ($playlist['public'] ? "Publique" : "Privée");
                        $auteur =  $data->getUtilisateur($playlist['id_auteur'])['nom_utilisateur']; 
                        echo '<p> Playlist • '.$status.' • Par '.$auteur.'</p>';
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
                        echo '<form id="PlayPlaylist" action="jouerPlaylist.php?id_playlist='.$id_playlist.'&aleatoire=false" method="post">';
                        echo '<input type="submit" id="jouerPlaylist" name="jouerPlaylist" style="display: none;">';
                        echo '<label for="jouerPlaylist"  title="Lire la playlist"><i class="material-icons">play_arrow</i></label>';
                        echo '</form>';

                        echo '<form id="PlayPlaylist" action="jouerPlaylist.php?id_playlist='.$id_playlist.'&aleatoire=true" method="post">';
                        echo '<input type="submit" id="jouerPlaylistAleatoire" name="jouerPlaylistAleatoire" style="display: none;">';
                        echo '<label for="jouerPlaylistAleatoire"  title="Lire la playlist aléatoirement"><i class="material-icons">shuffle</i></label>';
                        echo '</form>';
                        if ($_SESSION  && isset($_SESSION['user']) && $data->isFavorisPlaylist($id_playlist, $_SESSION['user']['id_utilisateur']) ?? false){
                            echo '<form id="Favoris" action="supprimerFavorisPlaylist.php?id='.$id_playlist.'" method="post">';
                            echo '<input type="submit" id="favAlbum" name="deleteFavoriteAlbum" style="display: none;">';
                            echo '<label for="favAlbum"  title="Supprimer des favoris"><i class="material-icons" id="UnFav">favorite</i></label>';
                            echo '</form>';
                        } else {
                            echo '<form id="Favoris" action="ajouterFavorisPlaylist.php?id='.$id_playlist.'" method="post">';
                            echo '<input type="submit" id="favAlbum" name="addFavoriteAlbum" style="display: none;">';
                            echo '<label for="favAlbum"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite</i></label>';
                            echo '</form>';
                        }
                        echo '</div>';
                        ?>
                        
                    </div>
                </div>
            </div>
            <div id="musiquesPlaylist">
                <?php

                foreach ($musiques as $musique) {
                    echo '<div id="musique">';
                    $album = $data->getAlbumByMusique($musique['id_musique']);
                    echo '<img id="imgMusiqueAlbum" src="./ressources/images/'.$album["image_album"].'">';
                    echo '<a href= "jouerPlaylist.php?id_playlist='.$id_playlist.'&aleatoire=false&musiqueStart='.$musique["id_musique"].'" id="PlayPlaylistMusique">';
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
                    echo '<label for="addFavoriteMusique"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite</i></label>';
                    echo '</form>';
                    if ($_SESSION  && isset($_SESSION['user']) && $playlist['id_auteur'] == $_SESSION['user']['id_utilisateur']){
                        echo '<form action="supprimerMusiquePlaylist.php?id_musique='.$musique['id_musique'].'&id_playlist='.$id_playlist.'" method="post">';
                        echo '<input type="submit" id="deleteMusiquePlaylist" name="deleteMusiquePlaylist" style="display: none;">';
                        echo '<label for="deleteMusiquePlaylist"  title="Supprimer de la playlist" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cette musique de la playlist ?\')"><i class="material-icons">delete</i></label>';
                        echo '</form>';
                    }
                    echo '<p>'.$musique['duree'].'</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div id="bottomPage" class="sections_accueil"></div>