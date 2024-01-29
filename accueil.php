<!DOCTYPE html>
<html>
<head>
    <title>Mon site de streaming de musique</title>
</head>
<body>
    <h1>Bienvenue sur mon site de streaming de musique</h1>
    <div id="player">
        <h2>Titre de la chanson</h2>
        <audio controls="controls">
            <source src="musics/ARK_MainTheme.mp3">
        </audio>
        <div id="video">
            <h2>Titre de la vidéo</h2>
            <!-- <iframe  width="560" height="315" src="https://drive.google.com/uc?export=download&id=1a4URD6ChccVe9BPDy8xnOUXtsC4kZGea" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
        </div>
        <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/1f2V8U1BiWaC9aJWmpOARe?utm_source=generator" width="100%" height="352" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    </div>
</body>
</html>