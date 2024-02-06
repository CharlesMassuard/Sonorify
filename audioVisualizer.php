<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Audio Visualizer based on Three.js</title>
  <link href="https://fonts.googleapis.com/css?family=Saira" rel="stylesheet">
  <link rel="stylesheet" href="./static/css/audioVisualizer.css">
  <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php include 'aside.php'; ?>
        <div id="content">
            <div id="out"></div>
        </div>
        <!-- partial -->
        <script  type="module" src="./static/js/audioVisualizer.js"></script>
</body>
</html>