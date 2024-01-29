<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">

    <style>
        #backToIndex {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #1d1d1d;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }

        #backToIndex a {
            text-decoration: none;
            color: white;
            font-size: 20px;
        }

        #backToIndex:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <?php include_once "../components/header/header.php"; ?>
    <h1 style="padding: 30px; text-align: center">404 error</h1>
    <h2 style="padding-bottom: 30px; text-align: center">Az oldal nem található.</h2>
    <button id="backToIndex"><a href="../pages/index">Vissza</a></button>
    <?php include_once "../components/footer/footer.php"; ?>
</body>

</html>