<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../components/header/header.css">
    <link rel="stylesheet" href="../../components/footer/footer.css">
    <title>Regisztráció</title>
</head>
<body>
    <?php include_once "../../components/header/header.php"; ?>

    <h1>Magan</h1>
    <form action="../../backend/register/private.php" method="post">
        <div>
            <label for="firstname">Vezetéknév:</label>
            <input type="text" name="firstname" id="firstname" autocomplete="off">
        </div>
        <div>
            <label for="lastname">Keresztnév:</label>
            <input type="text" name="lastname" id="lastname" autocomplete="off">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" autocomplete="off">
        </div>
        <div>
            <label for="phone">Telefonszám:</label>
            <input type="text" name="phone" id="phone" autocomplete="off">
        </div>
        <div>
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" autocomplete="off">
        </div>
        <div>
            <label for="confirm_password">Jelszó megerősítése:</label>
            <input type="password" name="confirm_password" id="confirm_password" autocomplete="off">
        </div>
        <input type="submit" value="Regisztráció">
    </form>

    
    <?php include_once "../../components/footer/footer.php"; ?>
    
</body>
</html>