<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin felület</title>
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">


</head>

<body>
    <?php include "../components/header/header.php"; ?>



    <?php
    
    require_once '../backend/connection.php';


$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
       echo '<div id = '.$row["id"].'>';
        echo "ID: ".$row["id"];
        echo "<input type='hidden' class='fajtaInput' value='" . $row["id"] . "'>";
        echo 'Fajta: <select class="fajta" name="fajta">';

        if ($row["userType"] == 1) {
            echo "<option value='admin' selected>admin</option>";
            echo "<option value='user'>user</option>";
            echo "<option value='valami'>valami</option>";
        } elseif ($row["userType"] == 2) {
            echo "<option value='admin'>admin</option>";
            echo "<option value='user' selected>user</option>";
            echo "<option value='valami' >valami</option>";
        } elseif ($row["userType"] == 3) {
            echo "<option value='admin'>admin</option>";
            echo "<option value='user'>user</option>";
            echo "<option value='valami' selected>valami</option>";
        }

        echo '</select><br>';
        echo '</select><br>';
        echo "Animal Shelter: " . $row["AnimalShelter"] . "<br>";
        echo "Email: " . $row["Email"] . "<br>";
        echo "Phone Number: " . $row["PhoneNumber"] . "<br>";
        echo "Zip Code: " . $row["ZipCode"] . "<br>";
        echo "City: " . $row["City"] . "<br>";
        echo '<\div>';
        echo "<hr>";
    }
} else {
    echo "Nincs találat.";
}



$sql = "SELECT * FROM animals WHERE alert = 1";


$result = $conn->query($sql);


if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . "<br>";
        echo "Név: " . $row["nev"] . "<br>";
        echo "Leírás: " . $row["leiras"] . "<br>";
        echo "Kor: " . $row["kor"] . "<br>";
        echo "Fajta: " . $row["fajta"] . "<br>";
        echo "Nem: " . $row["nem"] . "<br>";
        echo "Gondozás dátuma: " . $row["gondozasDatuma"] . "<br>";
        
        echo "<form method='post' action='../backend/deleteAnimal.php'>";
        echo "<input type='hidden' name='delete_animal' value='" . $row['id'] . "'>";
        echo "<input name='delete' type='submit' value='Törlés'>";
        echo "<input name='removeAlert' type='submit' value='Jelentés eltávolítása'>";
        echo "</form>";

        echo "<hr>";
    }
} else {
    echo "Nincs találat.";
}


$conn->close();
    ?>

    <?php include "../components/footer/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.fajta').on('change', function () {
                var selectedValue = $(this).val();
                console.log(selectedValue);
                var userId = $(this).closest('div').attr('id');;
                switch (selectedValue) {
                    case 'Magánszemély':
                        selectedValue = 1;
                        break;
                    case 'Ideiglenes befogadó':
                        selectedValue = 2;
                        break;
                    case 'Menhely':
                        selectedValue = 3;
                        break;
                    case 'Moderátor':
                        selectedValue = 4;
                        break;
                    case 'Admin':
                        selectedValue = 5;
                        break;
                    default:
                        selectedValue = 0;
                }

                $.ajax({
                    type: 'POST',
                    url: '../backend/updateProfile.php',
                    data: {
                        id: userId,
                        fajta: selectedValue
                    },
                    success: function (response) {

                        console.log(response);
                    },
                    error: function (error) {
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>