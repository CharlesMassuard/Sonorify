<!doctype html>
<html>
<head>
    <title>PHP'O SONG</title>
    <link rel="stylesheet" href="./static/css/header.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<header>
    <div id="search-container">
        <form action="search.php" method="get">
            <i class="material-icons" id="my-icon">search</i>
            <input type="text" id="search" placeholder="Rechercher un titre, un groupe, un artiste, un album, un genre">
            <input hidden=true type="submit" value="Rechercher">
        </form>
    </div>
    <section id="search_result">
    </section>
</header>