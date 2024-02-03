<!doctype html>
<html>
<head>
    <title>PHP'O SONG</title>
    <link rel="stylesheet" href="./static/css/player.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./static/js/player.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
</head>
<body>
    <div id="customPlayer">
        <div id="progressBar">
            <div id="progress">
                <div id="circle_progress"></div>
            </div>
        </div>
        <div class="infos">
            <div class="controls">
                <button id="prevButton"><i class="material-icons">skip_previous</i></button>
                <button id="playButton"><i class="material-icons">play_arrow</i></button>
                <button id="nextButton"><i class="material-icons">skip_next</i></button>
                <div id="currentTimeDisplay">--:-- / --:--</div>
            </div>
            <div id="infos_music">
                <img id="cover" src="./ressources/images/TerryAllen_Juarez.jpg" alt="cover">
                <div id='infos_ecrites'>
                    <h4 id="title">Finale</h4>
                    <div class="infos_supplementaires">Gareth Coker • ARK: Genesis Part 2 (Original Soundtrack) • 2021</div>
                </div>
            </div>
            <div class="controls2">
                <button id="repeatButton"><i class="material-icons">repeat</i></button>
            </div>
        <!-- <input type="range" id="volumeSlider" min="0" max="1" step="0.01" value="1"> -->
        </div>
    </div>
</body>
</html>