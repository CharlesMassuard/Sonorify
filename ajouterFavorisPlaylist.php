<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_playlist = $_POST['id_playlist'];
    $id_utilisateur = $_SESSION['user'].getIdUtilisateur(); 
}
?>