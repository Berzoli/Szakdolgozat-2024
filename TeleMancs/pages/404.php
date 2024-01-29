<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">
</head>

<body>
    <?php include_once "../components/header/header.php"; ?>
    <h1 style="padding: 30px; text-align: center">404 error</h1>
    <h2 style="padding-bottom: 30px; text-align: center">Az oldal nem található.</h2>
    <button><a href="../pages/index">Vissza</a></button>
    <?php include_once "../components/footer/footer.php"; ?>
</body>

</html>