<?php
require '../../bootloader.php';

$fileDB = new FileDB(DB_FILE);
$fileDB->load();

if (is_logged_in()) {
    $message = "Welcome back, {$_SESSION['email']}";
    $pixels = $fileDB->getRowsWhere('coordinates', ['email' => $_SESSION['email']]);
} else {
    header('Location: /login.php');
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styles.css">
    <title>MY</title>
</head>
<body>
<header>
    <?php require ROOT . '/core/templates/nav.php'; ?>
</header>
<main>
    <h1><?php print $message; ?></h1>
    <div class="poop_wall">
        <?php foreach ($pixels as $pixel) : ?>
            <span class="poop <?php print $pixel['color']; ?>"
                  style="left:<?php print $pixel['x']; ?>px; top:<?php print $pixel['y']; ?>px"></span>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>

