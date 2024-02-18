<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom_groupe = $_POST['nom_groupe'];
        $description = $_POST['description'];
        $image = $_POST['image'];
        $user = $_SESSION['user'];
        require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
        $db = new Data\Database();
        $db->creerGroupe($nom_groupe, $description, $image);
        $id_groupe = $db->getGroupesByName($nom_groupe)[0]['id_groupe'];
        if ($id_groupe){
            header('Location: /Pages/Views/groupe.php?id='.$id_groupe);
        } else {
            echo "<strong>Le groupe n'a pas été créé</strong>";
        }
    } 
?>
<form action="creerGroupe.php" method="post" id ="Creer">
    <label for="nom_groupe">Nom de Groupe</label>
    <input type="text" id="nom_groupe" name="nom_groupe" required>
    <label for="description">Description</label>
    <input type="text" id="description" name="description">
    <label for="image">Image:</label><br>
    <input type="text" id="image" name="image"><br>
    <input type="submit" value="Créer">
</form>