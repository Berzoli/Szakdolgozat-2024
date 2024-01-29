<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">
    <link rel="stylesheet" href="../css/bejelentkezes.css">
    <title>Bejelentekzés</title>

    <style>
        #loginFormContainer {
            background-color: #1d1d1d;;
            width: 700px;
            margin: auto;
            margin-top: 100px;
            margin-bottom: 100px;
            color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        #loginFormContainer h1 {
            text-align: center;
            padding: 10px;
        }

        #loginFomrContainer form {
            display: flex;
            flex-direction: column;
        }
        #loginForm {
            padding: 10px;
            background-color: white;
        }

        #loginForm div {
            display: flex;
            margin: auto;
            align-items: center;
        }

        #loginForm div input {
            margin: auto;
            padding: 5px;
            width: 300px;
            font-size: 20px;
            margin-bottom: 20px;
        }

        #loginForm div input[type="submit"] {
            border: none;
            background-color: #1d1d1d;;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        #loginForm div input[type="submit"]:hover {
            transform: scale(1.05);
        }

        #loginFormContainer > div {
            padding: 20px;
        }

        #loginFormContainer > div > a {
            color: white;
            text-decoration: none;
        }

    </style>
</head>

<body>
    <?php include_once "../components/header/header.php"; ?>
    <div id="loginFormContainer">
        <h1>Bejelentkezés</h1>
        <form id="loginForm" action="../backend/login.php" method="post">
            <div>
                <input type="text" name="email" id="bejelentkezes" autocomplete="off" placeholder="E-mail cím">
            </div>
            <div>
                <input type="password" name="password" id="jelszo" autocomplete="off" placeholder="Jelszó">
            </div>
            <div>
                <input type="submit" value="Bejelentkezés">
            </div>
            

        </form>
        <div>
            Még nem regisztráltál? <a href="http://localhost/szakdolgozat/TeleMancs/pages/regisztracio">itt megteheted</a>!
        </div>
    </div>
    
    <?php include_once "../components/footer/footer.php"; ?>
</body>

</html>