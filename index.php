<?php
declare(strict_types=1);
session_start();

// Autoload
// require 'Classes/Autoloader.php';
// Autoloader::register();

?>

<!doctype html>
<html>
<head>
    <title>Sonorify</title>
    <link rel="icon" type="image/x-icon" href="./ressources/images/logo.png">
    <link rel="stylesheet" href="./static/css/index.css">
    <link rel="stylesheet" href="./static/css/aside.css">
    <link rel="stylesheet" href="./static/css/header.css">
    <link rel="stylesheet" href="./static/css/player.css">
    <link rel="stylesheet" href="./static/css/playlist.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./static/js/index.js" defer></script>
    <script src="./static/js/accueil.js" defer></script>
    <script src="./static/js/playlist.js" defer></script>
</head>
<?php #include 'player.php'; ?> 
<body>
    <?php include 'aside.php'; ?>
    <?php include 'header.php'; ?>
    <main>
        <script src="./static/js/spa.js" defer></script>
        <?php 
        if (!isset($_SESSION['page'])) {
            include 'accueil.php';
        } else {
            include $_SESSION['page'];
        }
        ?>
    </main>
    <?php include 'player.php'; ?>
</body>
</html>