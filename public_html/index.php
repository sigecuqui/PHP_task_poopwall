<?php

require '../bootloader.php';

$fileDB = new fileDB(DB_FILE);
$fileDB->load();

$pixels = $fileDB->getRowsWhere('coordinates');

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="index__body">
<?php include(ROOT . '/core/templates/nav.php'); ?>
<main>
    <div class="poop_wall">
        <?php foreach ($pixels as $pixel): ?>
            <span class="poop <?php print $pixel['color']; ?>" style="left:<?php print $pixel['x']; ?>px; top:<?php print $pixel['y']; ?>px"></span>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>

