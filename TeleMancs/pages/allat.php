<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Állat</title>
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">
</head>

<body>

    <?php include "../components/header/header.php"; ?>


    <?php

require_once '../backend/connection.php';


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['animal_id'])) {
    $animalId = $_GET['animal_id'];

    // SQL lekérdezés az adott állat adatainak lekérésére
    $sqlAnimal = "SELECT animals.id, animals.nev, animals.leiras, animals.kor, animals.fajta, animals.nem, animals.gondozasDatuma, animals.Alert, users.PhoneNumber, users.Email, images.image_path
                  FROM animals
                  JOIN users ON animals.userId = users.id JOIN images ON animals.id = images.animalId
                  WHERE animals.id = $animalId";

    $resultAnimal = $conn->query($sqlAnimal);


    if ($resultAnimal->num_rows > 0) {
    
        $row = $resultAnimal->fetch_assoc();
        echo "ID: " . $row["id"] . "<br>";
        echo "Név: " . $row["nev"] . "<br>";
        echo "Leírás: " . $row["leiras"] . "<br>";
        echo "Kor: " . $row["kor"] . "<br>";
        echo "Fajta: " . $row["fajta"] . "<br>";
        echo "Nem: " . $row["nem"] . "<br>";
        echo "Gondozás dátuma: " . $row["gondozasDatuma"] . "<br>";
        echo "Felhasználó telefonszáma: <a href='tel:" . $row["PhoneNumber"] . "'>" . $row["PhoneNumber"] . "</a> </br>";
        echo "Felhasználó e-mail címe: " . $row["Email"] . "<br>";
        if ($row["image_path"] != null) {
            echo '<img src="' . $row["image_path"] . '" alt="Állat képe" width="100"><br>';

        } else {
            echo 'Nincs kép az állathoz';
        }
        echo "<form id='alertForm' action='../backend/alert.php' method='post'>";

        if ($row["Alert"] == 0 || $row["Alert"] == null) {
            echo "<input type='submit' value='Jelentés'>";
        } else {
            echo "<input disabled type='submit' value='Jelentve'>";
        }
        
        echo "<input type='hidden' name='animalId' value='" . $row["id"] . "'>";
        echo "</form>";
    } else {
        echo "Nincs találat az adott állatra.";
    }
}


// ...
?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#alertForm").submit(function (event) {
                event.preventDefault();

                
                $.ajax({
                    type: "POST",
                    url: "../backend/alert.php",
                    data: $(this).serialize(),
                    success: function (response) {
                        
                        console.log(response);
                        alert("Sikeres jelentés!");
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <?php include "../components/footer/footer.php"; ?>

</body>

</html>