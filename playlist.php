
<?php 
    session_start();
    $id_playlist = $_GET['id'] ?? 1;
    $_SESSION['page'] = 'playlist.php?id='.$id_playlist;
    require_once 'Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $playlist = $data->getPlaylist($id_playlist);
    $musiques = $data->getMusiquesPlaylist($id_playlist);
    $nbrMusiques = count($musiques);
?>
        <div id="playlistAlbum">
            <div id="playlist">
                <?php $image = $data->getMusiquesAlbumsByPlaylist($id_playlist)['image_album'] ?? 'default.jpg'; ?>
                <img id="imgPlaylistAlbum" src="./static/img/<?php echo $image; ?>">
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
                        if($nbrMusiques <= 1){
                            echo $nbrMusiques." Titre • ".$dureeTotale . "</p>";
                        } else {
                            echo $nbrMusiques." Titres • ".$dureeTotale . "</p>";
                        }
                        echo '<div id="note">';
                        if (isset($_SESSION['user']) && $data->isPlaylistNotee($playlist['id_playlist'], $_SESSION['user']['id_utilisateur']) ?? false){
                            $note = $data->getNotePlaylist($playlist['id_playlist'], $_SESSION['user']['id_utilisateur'])['note'];
                        } else {
                            $note = 0;
                        }
                        for ($i=0; $i < 5; $i++) { 
                            
                            if ($i<$note){
                                echo '<a id="ajout_note" href="ajouterNotePlaylist.php?id='.$playlist['id_playlist'].'&note='.($i+1).'" class="active">';
                            } else {
                                echo '<a id="ajout_note" href="ajouterNotePlaylist.php?id='.$playlist['id_playlist'].'&note='.($i+1).'">';
                            }
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
                            echo '<label for="favAlbum"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite_border</i></label>';
                            echo '</form>';
                        }
                        echo '</div>';
                        ?>
                        
                    </div>
                </div>
            </div>
            <div id="musiquesPlaylist">
                <?php
                if (isset($_SESSION['user']) && $playlist['id_auteur'] == $_SESSION['user']['id_utilisateur']){
                    echo '<form id="ajouterMusiquePlaylist" action="ajouterMusiquePlaylist.php?id='.$id_playlist.'" method="post">';
                    echo '<input type="text" id="nomMusiquePlaylist" name="nom_musique" list="musiques" placeholder="Ajouter une musique à la playlist">';
                    echo '<datalist id="musiques">';
                    foreach ($data->getMusiques() as $musique) {
                        echo '<option value="'.$musique['nom_musique'].'">';
                    }
                    echo '</datalist>';
                    echo '<input type="submit" id="addmusique" name="addmusique" style="display: none;">';
                    echo '<label for="addmusique"  title="Ajouter une musique à la playlist"><i class="material-icons">add</i></label>';
                    echo '</form>';
                }
                foreach ($musiques as $musique) {
                    echo '<div id="musique">';
                    $album = $data->getAlbumByMusique($musique['id_musique']);
                    echo '<img id="imgMusiqueAlbum" src="./static/img/'.$album["image_album"].'">';
                    echo '<a href= "jouerPlaylist.php?id_playlist='.$id_playlist.'&aleatoire=false&musiqueStart='.$musique["id_musique"].'" id="PlayPlaylistMusique">';
                    echo '<h2>'.$musique['nom_musique'].'</h2>';
                    echo '</a>';
                    echo '<a id="Groupe" href="groupe.php?id='.$musique['id_groupe'].'">'.$data->getGroupe($musique['id_groupe'])['nom_groupe'].'</a>';
                    echo '<div id="note">';

                    if (isset($_SESSION['user']) && $data->isMusiqueNotee($musique['id_musique'], $_SESSION['user']['id_utilisateur']) ?? false){
                        $note = $data->getNoteMusique($musique['id_musique'], $_SESSION['user']['id_utilisateur'])['note'];
                    } else {
                        $note = 0;
                    }
                    for ($i=0; $i < 5; $i++) { 
                        if ($i<$note){
                            echo '<a id="ajout_note" href="ajouterNoteMusique.php?id='.$musique['id_musique'].'&note='.($i+1).'" class="active">'; 
                        } else {
                            echo '<a id="ajout_note" href="ajouterNoteMusique.php?id='.$musique['id_musique'].'&note='.($i+1).'">';
                        }
                        echo '<i class="material-icons">star</i>';
                        echo '</a>';
                    }
                    echo '</div>';
                    if (isset($_SESSION['user']) && $data->isMusiqueNotee($musique['id_musique'], $_SESSION['user']['id_utilisateur']) ?? false){
                        $note = $data->getNoteMusique($musique['id_musique'], $_SESSION['user']['id_utilisateur'])['note'];
                        echo '<p>'.$note.'/5</p>';
                    } else {
                        echo '<p>0/5</p>';
                    }
                    if (isset($_SESSION['user']) && $data->isFavorisMusique($musique['id_musique'], $_SESSION['user']['id_utilisateur']) ?? false){
                        echo '<form id="Favoris" action="supprimerFavorisMusique.php?id='.$musique['id_musique'].'" method="post">';
                        echo '<input type="submit" id="favMusique'.$musique['id_musique'].'" name="deleteFavoriteMusique" style="display: none;">';
                        echo '<label for="favMusique'.$musique['id_musique'].'"  title="Supprimer des favoris"><i class="material-icons" id="UnFav">favorite</i></label>';
                        echo '</form>';
                        } else {
                        echo '<form id="Favoris" action="ajouterFavorisMusique.php?id='.$musique['id_musique'].'" method="post">';
                        echo '<input type="submit" id="favMusique'.$musique['id_musique'].'" name="addFavoriteMusique" style="display: none;">';
                        echo '<label for="favMusique'.$musique['id_musique'].'"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite_border</i></label>';
                        echo '</form>';
                    }
                    if ($_SESSION  && isset($_SESSION['user']) && $playlist['id_auteur'] == $_SESSION['user']['id_utilisateur']){
                        echo '<form id="Supprimer" action="supprimerMusiquePlaylist.php?id_musique='.$musique['id_musique'].'&id_playlist='.$id_playlist.'" method="post">';
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