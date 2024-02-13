<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Audio Visualizer based on Three.js</title>
  <link href="https://fonts.googleapis.com/css?family=Saira" rel="stylesheet">
  <link rel="stylesheet" href="./static/css/audioVisualizer.css">
  <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
</head>
<body id="bodyAudioVisualizer">
<?php include 'player.php'; ?>
        <div id="content">
            <div id="out"></div>
        </div>
        <!-- partial -->
        <script src='https://cdnjs.cloudflare.com/ajax/libs/three.js/84/three.min.js'></script>
        <script src='https://cdn.rawgit.com/mrdoob/three.js/master/examples/js/controls/OrbitControls.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.6.3/dat.gui.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/simplex-noise/2.3.0/simplex-noise.min.js'></script>
        <script  type="module" src="./static/js/audioVisualizer.js"></script>
</body>
</html>