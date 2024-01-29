<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_groupe = $_POST['id_groupe'];
    $id_utilisateur = $_SESSION['user'].getIdUtilisateur(); 
    $data = new Data\DataBase();
    $userStatement = $data->insertFavoriteGroupe($id_groupe, $id_utilisateur);
}
?>