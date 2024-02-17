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
    <link rel="icon" type="image/x-icon" href="./static/img/logo.png">
    <link rel="stylesheet" href="./static/css/index.css">
    <link rel="stylesheet" href="./static/css/aside.css">
    <link rel="stylesheet" href="./static/css/header.css">
    <link rel="stylesheet" href="./static/css/player.css">
    <link rel="stylesheet" href="./static/css/playlist.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./static/js/index.js" defer></script>
    <script src="./static/js/accueil.js" defer></script>
    <script src="./static/js/playlist.js" defer></script>
    <script type="module" src="./static/js/header.js" defer></script>
</head>
<body>
    <?php include 'aside.php'; ?>
    <?php include 'header.php'; ?>
    <main>
        <script src="./static/js/spa.js" type="module" defer></script>
        <?php 
        $_SESSION['page'] = null;
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