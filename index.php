<?php
declare(strict_types=1);

// Autoload
require 'Classes/Autoloader.php';
Autoloader::register();

// Version BD
use Data\DataBase;
$data = new DataBase();

//Get instances of questions
$q = $data->load();
$questions = Factory::createQuestions($q);
?>

<!doctype html>
<html>
<head>
    <title>PHP'oSong</title>
    <link rel="stylesheet" href="./static/css/index.css">
</head>
<body>