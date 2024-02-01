<?php
declare(strict_types=1);
session_start();

require_once 'Data/DataBase.php';
$data = new Data\DataBase();

// Autoload
require 'Classes/Autoloader.php';
Autoloader::register();
?>

<!doctype html>
<html>
<head>
    <title>PHP'oSong</title>
    <link rel="stylesheet" href="./static/css/index.css">
</head>
<?php 
    if ($_SESSION['user'] == null) {
        header('Location: login.php');
    }
?>
<body>