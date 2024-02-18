
<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $id_album = $_GET['id'] ?? 1;
    $_SESSION['page'] = 'album.php?id='.$id_album;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $album = $data->getAlbum($id_album);
    $musiques = $data->getMusiquesAlbum($id_album);
    $nbrMusiques = count($musiques);
    $groupe = $data->getAlbumsArtistesByIdAlbum($album['id_album']);
?>
<div id="playlistAlbum">
    <div id="playlist">
        <img id="imgPlaylistAlbum" src="/static/img/<?php 
        $image_album = __DIR__ ."/../../static/img/".$album["image_album"];
        if (!file_exists($image_album)) {
            $image_album = "default.jpg"; // replace with your default image name
        }echo $image_album?>">
        <div id="playlistDetails">
            <h1><?php echo $album['titre'] ?></h1>
            <?php  
                $dateSortie = substr($album["dateSortie"], -4);
                echo '<p> Album  • '.$groupe['nom_groupe'].' • '.$dateSortie.'</p>';
                ?>
            <p><?php 
            $somme = 0;
            foreach ($musiques as $musique) {
                // Divisez la durée en minutes et secondes
                list($minutes, $secondes) = explode(':', $musique['duree']??"00:00");
                
                // Convertissez la durée en secondes et ajoutez-la à $somme
                $somme += (int)$minutes * 60 + (int)$secondes;
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
            if($nbrMusiques <= 1){
                echo $nbrMusiques." Titre • ".$dureeTotale . "</p>";
            } else {
                echo $nbrMusiques." Titres • ".$dureeTotale . "</p>";
            }
            echo '<div id="note">';
            if (isset($_SESSION['user']) && $data->isAlbumNotee($album['id_album'], $_SESSION['user']['id_utilisateur']) ?? false){
                $note = $data->getNoteAlbum($album['id_album'], $_SESSION['user']['id_utilisateur'])['note'];
            } else {
                $note = 0;
            }
            for ($i=0; $i < 5; $i++) { 
                if ($i<$note){
                    echo '<a id="ajout_note" href="/Pages/Request/ajouterNoteAlbum.php?id='.$album['id_album'].'&note='.($i+1).'" class="active">';
                } else {
                    echo '<a id="ajout_note" href="/Pages/Request/ajouterNoteAlbum.php?id='.$album['id_album'].'&note='.($i+1).'">';
                }
                echo '<i class="material-icons">star</i>';
                echo '</a>';
            }
            echo '</div>';
            echo '<div id="inputPlaylistAlbum">';
            echo '<form id="PlayAlbum" action="/Pages/Request/jouerAlbum.php?id_album='.$album["id_album"].'&aleatoire=false" method="post">';
            echo '<input type="submit" id="jouerAlbum" name="jouerAlbum" style="display: none;">';
            echo '<label for="jouerAlbum"  title="Lire l\'album"><i class="material-icons">play_arrow</i></label>';
            echo '</form>';
            echo '<form id="PlayAlbum" action="/Pages/Request/jouerAlbum.php?id_album='.$album["id_album"].'&aleatoire=true" method="post">';
            echo '<input type="submit" id="jouerAlbumAleatoire" name="jouerAlbumAleatoire" style="display: none;">';
            echo '<label for="jouerAlbumAleatoire"  title="Lire l\'album aléatoirement"><i class="material-icons">shuffle</i></label>';
            echo '</form>';
            if ($_SESSION  && isset($_SESSION['user']) && is_array($_SESSION) && $data->isFavorisAlbum($id_album, $_SESSION['user']['id_utilisateur']) ?? false){
                echo '<form id="Favoris" action="/Pages/Request/supprimerFavorisAlbum.php?id='.$id_album.'" method="post">';
                echo '<input type="submit" id="favAlbum" name="deleteFavoriteAlbum" style="display: none;">';
                echo '<label for="favAlbum"  title="Supprimer des favoris"><i class="material-icons" id="UnFav">favorite</i></label>';
                echo '</form>';
            } else {
                echo '<form id="Favoris" action="/Pages/Request/ajouterFavorisAlbum.php?id='.$id_album.'" method="post">';
                echo '<input type="submit" id="favAlbum" name="addFavoriteAlbum" style="display: none;">';
                echo '<label for="favAlbum"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite_border</i></label>';
                echo '</form>';
            }
            if (isset($_SESSION) && isset($_SESSION['user']) && $_SESSION['user']['id_role'] == 2){
                echo '<a id="Album" href="/Pages/Views/modifierAlbum.php?id='.$album["id_album"].'"><i class="material-icons">create</i></a>';
                echo '<a id="Album" href="/Pages/Request/supprimerAlbum.php?id='.$album["id_album"].'"><i class="material-icons">delete</i></a>';
            }
            echo '</div>';
            ?>
        </div>
    </div>
    <div id="musiquesAlbum">
        <form action="/Pages/Request/ajouterMusiqueAlbum.php?id_album=<?php echo $id_album ?>" method="post">
            <input type="text" id="nom_musique" name="nom_musique" list="musiques" placeholder="Ajouter une musique à l'album">
            <datalist id="musiques">
            <?php
            $musiques_accessible = $data->getMusiquesNonAlbum($id_album);
            foreach ($musiques_accessible as $musique) {
                echo '<option value="'.$musique['nom_musique'].'">';
            }
            ?>
            </datalist>
            <input type="submit" id="ajouterMusiqueAlbum" name="ajouterMusiqueAlbum" style="display: none;">
            <label for="ajouterMusiqueAlbum"  title="Ajouter une musique à l'album"><i class="material-icons">add</i></label>
        </form>
        <?php 
        
        foreach ($musiques as $musique) {
            echo '<div id="musique">';
            echo '<img id="imgMusiqueAlbum" src="/static/img/'.$album['image_album'].'">';
            echo '<a id="PlayAlbumMusique" href= "/Pages/Request/jouerAlbum.php?id_album='.$album["id_album"].'&aleatoire=false&musiqueStart='.$musique["id_musique"].'" method="post">';
            echo '<h2>'.$musique['nom_musique'].'</h2>';
            echo '</a>';
            echo '<a id="Groupe" href="/Pages/Views/groupe.php?id='.$musique['id_groupe'].'">'.$data->getGroupe($musique['id_groupe'])['nom_groupe'].'</a>';
            echo '<div id="note">';
            if (isset($_SESSION['user']) && $data->isMusiqueNotee($musique['id_musique'], $_SESSION['user']['id_utilisateur']) ?? false){
                $note = $data->getNoteMusique($musique['id_musique'], $_SESSION['user']['id_utilisateur'])['note'];
            } else {
                $note = 0;
            }
            for ($i=0; $i < 5; $i++) { 
                if ($i<$note){
                    echo '<a id="ajout_note" href="/Pages/Request/ajouterNoteMusique.php?id='.$musique['id_musique'].'&note='.($i+1).'" class="active">'; 
                } else {
                    echo '<a id="ajout_note" href="/Pages/Request/ajouterNoteMusique.php?id='.$musique['id_musique'].'&note='.($i+1).'">';
                }
                echo '<i class="material-icons">star</i>';
                echo '</a>';
            }
            echo '</div>';
            $note_moyenne = $data->getNoteMoyenneMusique($musique['id_musique'])['moyenne_note'] ?? 0;
            echo '<p>'.$note_moyenne.'/5</p>';
            if (isset($_SESSION['user']) && $data->isFavorisMusique($musique['id_musique'], $_SESSION['user']['id_utilisateur']) ?? false){
                echo '<form id="Favoris" action="/Pages/Request/supprimerFavorisMusique.php?id='.$musique['id_musique'].'" method="post">';
                echo '<input type="submit" id="favMusique'.$musique['id_musique'].'" name="deleteFavoriteMusique" style="display: none;">';
                echo '<label for="favMusique'.$musique['id_musique'].'"  title="Supprimer des favoris"><i class="material-icons" id="UnFav">favorite</i></label>';
                echo '</form>';
                } else {
                echo '<form id="Favoris" action="/Pages/Request/ajouterFavorisMusique.php?id='.$musique['id_musique'].'" method="post">';
                echo '<input type="submit" id="favMusique'.$musique['id_musique'].'" name="addFavoriteMusique" style="display: none;">';
                echo '<label for="favMusique'.$musique['id_musique'].'"  title="Ajouter aux favoris"><i class="material-icons" id="Fav">favorite_border</i></label>';
                echo '</form>';
            }
            if($musique['duree'] == ""){
                echo '<p> 0:00 </p>';
            } else {
                echo '<p>'.$musique['duree'].'</p>';
            }
            echo '</div>';
        }
        ?>
    </div>
</div>
<div id="bottomPage" class="sections_accueil"></div>