<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }
    $id_groupe = $_GET['id'] ?? 1;
    $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    $groupe = $data->getGroupe($id_groupe);
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nom_groupe = $_POST['nom_groupe'];
        $image_groupe = $_POST['image_groupe'];
        $description_groupe = $_POST['description_groupe'];
        $data->updateGroupe($id_groupe, $nom_groupe, $description_groupe, $image_groupe);
        header('Location: /Pages/Views/groupe.php?id='.$id_groupe);
    }
?>

<form id="Modifier" method="post" action="/Pages/Views/modifierGroupe.php?id=<?php echo $id_groupe ?>">
    <input type="hidden" name="id_groupe" value="<?php echo $id_groupe ?>">
    <label for="nom_groupe">Nom du groupe</label>
    <input type="text" name="nom_groupe" placeholder="Nom du groupe" value="<?php echo $groupe['nom_groupe'] ?>">
    <label for="image_groupe">Image du groupe</label>
    <input type="text" name="image_groupe" placeholder="Image du groupe" value="<?php echo $groupe['image_groupe'] ?>">
    <label for="description_groupe">Description du groupe</label>
    <input type="text" name="description_groupe" placeholder="Description du groupe" value="<?php echo $groupe['description_groupe'] ?>">
    <input type="submit" value="Modifier">
</form>