<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilom</title>

    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        body > h2 {
            margin-top: 50px;
        }
        .myAnimals {
            display: flex;
            flex-wrap: wrap;
        }

        .animalContainer {
            width: 400px;
            padding: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            margin: 20px;
            border-radius: 15px;
            background-color: white;
        }

        #cover {
            position: fixed;
            z-index: 1000;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            top: 0;
            left: 0;
            display: none;
        }

        #selectedAnimal {
            background-color: white;
            width: 400px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
        }

        #selectedAnimal div,
        h2 {
            margin-bottom: 20px;
        }

        #selectedAnimal h2 {
            text-align: center;
        }

        #selectedAnimal button[type="submit"] {
            display: flex;
            margin: auto;
            font-size: 30px;
            padding: 10px;
        }

        #profileDatas {
            padding: 20px;
            width: 500px;
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            background-color: white;
        }

        #profileDatas form div {
            display: flex;
            font-size: 20px;
        }

        #profileDatas form input {
            width: 60%;
            margin-top: 20px;
            font-size: 20px;
            padding: 5px;
            border-radius: 5px;
            border: 2px solid #4928c2;
            right: 0;
        }

        #profileDatas form input:focus {
            outline: none;
        }

        #profileDatas > h2 {
            text-align: center;
        }

        #profileDatas form label {
            width: 40%;
            margin-top: 20px;
        }

        #profileDatas form input[type="submit"] {
            margin: auto;
            text-align: center;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.2s ease;
            background-color: #4928c2;
            color: white;
        }

        #profileDatas form input[type="submit"]:hover {
            background-color: white;
            color: #4928c2;
        }

        #animalUpload {
            width: 500px;
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
            background-color: white;
        }

        #animalUpload form label {
            width: 40%;
            
        }

        #animalUpload form input, textarea, select {
            width: 60%;
            font-size: 20px;
            padding: 5px;
            border-radius: 5px;
            border: 2px solid #4928c2;
        }

        #animalUpload form div {
            display: flex;
            align-items: center;
            margin-top: 20px;
            font-size: 20px;
        }

        #animalUpload form input[type="submit"] {
            margin: auto;
            text-align: center;
            color: white;
            background-color: #4928c2;
            border-radius: 5px;
            cursor: pointer;
        }

        #datasContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.2);
            margin: 50px 0 50px 0;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include_once "../components/header/header.php";?>

    <?php
    
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
        
        require_once '../backend/connection.php';

       
        $userId = $_SESSION['userId'];
        $usertype = $_SESSION['userType'];


       
        $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();

           
            if ($usertype == 2 || $usertype == 2) {
                echo '<h2>Üdvözlünk a profilodban, ' . $userData['Firstname'] . ' ' . $userData['Lastname'] . '!</h2>';
            }

            if ($usertype == 3) {
                echo '<h2>Üdvözlünk a profilodban!</h2>';
            }

            echo '<p>Itt lehetőséged van megadni a profiladataidat, illetve állatokat is tölthetsz fel!</p>';



        } else {
            
            echo 'User not found.';
        }



    $sql = "SELECT * FROM users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $firstname = $row["Firstname"];
        $lastname = $row["Lastname"];
        $email = $row["Email"];
        $phone = $row["PhoneNumber"];
        $usertype = $row["userType"];
        $animalshelter = $row["AnimalShelter"];
        $zipcode = $row["ZipCode"];
        $city = $row["City"];
    } else {
       
        $firstname = "";
        $lastname = "";
        $email = "";
        $phone = "";
        $zipcode = "";
        $city = "";
    }




    $stmt->close();
} else {
    
    header("Location: bejelentkezes.php");
    exit();
}
?>  

<div id="datasContainer">
<div id="profileDatas">
        <h2>Profil Módosítás</h2>
        <form id="profileForm" action="../backend/updateProfile.php" method="post">

            <?php if($usertype == 1 || $usertype == 2): ?>
            <div>
                <label for="firstname">Vezetéknév</label>
                <input type="text" name="firstname" id="firstname" autocomplete="off" value="<?= $firstname; ?>">
            </div>
            <div>
                <label for="lastname">Keresztnév</label>
                <input type="text" name="lastname" id="lastname" autocomplete="off" value="<?= $lastname; ?>">
            </div>

            <?php elseif ($usertype == 3) : ?>
            <div>
                <label for="animalshelter">Menhely neve</label>
                <input type="text" name="animalshelter" id="animalshelter" autocomplete="off"
                    value="<?= $animalshelter; ?>">
            </div>
            <?php endif; ?>

            <div>
                <label for="zipcode">Irányítószám</label>
                <input type="text" name="zipcode" id="zipcode" autocomplete="off" value="<?= $zipcode; ?>">
            </div>

            <div>
                <label for="city">Település</label>
                <input type="text" name="city" id="city" autocomplete="off" value="<?= $city; ?>">
            </div>

            <div>
                <label for="phone">Telefonszám</label>
                <input type="text" name="phone" id="phone" autocomplete="off" value="<?= $phone; ?>">
            </div>

            <div>
                <input type="submit" value="Mentés">
            </div>
        </form>
    </div>


    <div id="animalUpload">
    <h2>Állat feltöltése</h2>

    <form action="../backend/uploadAnimal.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="nev">Állat neve:</label>
            <input type="text" name="nev" id="nev" required>
        </div>
        <div>
            <label for="leiras">Leírás:</label>
            <textarea name="leiras" id="leiras" rows="4" required></textarea>
        </div>
        <div>
            <label for="kor">Kor:</label>
            <input type="number" name="kor" id="kor" required>
        </div>
        <div>
            <label for="fajta">Fajta:</label>
            <input type="text" name="fajta" id="fajta" required>
        </div>
        <div>
            <label for="nem">Nem:</label>
            <select name="nem" id="nem" required>
                <option value="Hím">Hím</option>
                <option value="Nőstény">Nőstény</option>
            </select>
        </div>
        <div>
            <label for="gondozasDatuma">Gondozás dátuma:</label>
            <input type="date" name="gondozasDatuma" id="gondozasDatuma" required>
        </div>
        <div>
            <label for="image">Kép feltöltése:</label>
            <input type="file" name="image" id="image" accept="image/*" required multiple>
        </div>
        <div>
            <input type="submit" value="Állat feltöltése">
        </div>
    </form>

    </div>
</div>
    


    <!-- Állat módosítása -->

    <div class="myAnimals">
        <?php
        require_once '../backend/connection.php';
        // Állatok listázása
        $sqlList = "SELECT animals.id as animalId, animals.nev as nev, animals.leiras as leiras, animals.kor as kor, animals.fajta as fajta, animals.nem as nem, animals.gondozasDatuma as gondozasDatuma, images.image_path as image_path
        FROM animals
        INNER JOIN images ON animals.id = images.animalID
        WHERE animals.userId = $userId";

        $resultList = $conn->query($sqlList);

        if ($resultList->num_rows > 0) {
            
            while ($row = $resultList->fetch_assoc()) {
                echo "<div class='animalContainer'>";
                echo "<p>Állat id: " . $row["animalId"] . "</p>";
                echo "<p>Állat neve: " . $row["nev"] . "</p>";
                echo "<p>Leírás: " . $row["leiras"] . "</p>";
                echo "<p>Kor: " . $row["kor"] . "</p>";
                echo "<p>Fajta: " . $row["fajta"] . "</p>";
                echo "<p>Nem: " . $row["nem"] . "</p>";
                echo "<p>Gondozás dátuma: " . $row["gondozasDatuma"] . "</p>";
                
                if ($row["image_path"] != null) {
                        echo '<img src="' . $row["image_path"] . '" alt="Állat képe" width="100"><br>';

                } else {
                    echo 'Nincs kép az állathoz';
                }
                              
                echo "<button onclick='showAnimalDetails(" . $row['animalId'] . ")'> Módosítás </button><br>";
                echo "<form method='post' action='../backend/deleteAnimal.php'>";
                echo "<input type='hidden' name='delete_animal' value='" . $row['animalId'] . "'>";
                echo "<button type='submit'> Törlés </button>";
                echo "</form>";
                echo "</div>";

               

            }
        } else {
            echo "Nincs találat az állataidra.";
        }
        $conn->close();
    ?>
    </div>


    <div id="cover">
        <div id="selectedAnimal">
            <h2>Állat adatai</h2>
            <form id="updateForm" method="POST">
                <div>
                    <label for="animalName">Állat neve:</label>
                    <input type="text" id="animalName" name="animalName">
                </div>

                <div>
                    <label for="animalDescription">Leírás:</label>
                    <textarea id="animalDescription" name="animalDescription"></textarea>
                </div>

                <div>
                    <label for="animalAge">Kor:</label>
                    <input type="number" id="animalAge" name="animalAge">
                </div>

                <div>
                    <label for="animalType">Fajta:</label>
                    <input type="text" id="animalType" name="animalType">
                </div>


                <div>
                    <label for="animalGender">Nem:</label>
                    <select id="animalGender" name="animalGender">
                        <option value="Hím">Hím</option>
                        <option value="Nőstény">Nőstény</option>
                    </select>
                </div>


                <div>
                    <label for="animalDate">Gondozás dátuma:</label>
                    <input type="date" id="animalDate" name="animalDate">
                </div>


                <?php echo "<input type='hidden' id='animalId' name='animalId' value=''>"; ?>

              

                <button onclick="updateAnimal()" type="submit">Mentés</button>
            </form>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("#profileForm").submit(function (event) {
                event.preventDefault(); 

                
                $.ajax({
                    type: "POST",
                    url: "../backend/updateProfile.php",
                    data: $(this).serialize(), 
                    success: function (response) {
                       
                        console.log(response);
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });


        function showAnimalDetails(animalId) {
            console.log(animalId);
            var apiUrl = '../backend/getAnimal.php'; 



           
            $.ajax({
                url: apiUrl,
                type: 'HEAD',
                success: function () {
                   
                    fetchData(animalId, apiUrl);
                },
                error: function () {
                    alert('The URL does not exist or cannot be reached.');
                }
            });

            var cover = document.getElementById('cover');
            cover.style.display = 'block';
            document.getElementsByTagName('body')[0].style.overflow = 'hidden';
        }

        function fetchData(animalId, apiUrl) {
           
            $.ajax({
                url: apiUrl,
                method: 'POST',
                data: {
                    "animalId": animalId
                },
                success: function (response) {
                    console.log(response.data);
                    
                    $('#animalName').val(response.data.nev);
                    $('#animalDescription').val(response.data.leiras);
                    $('#animalAge').val(response.data.kor);
                    $('#animalType').val(response.data.fajta);
                    $('#animalDate').val(response.data.gondozasDatuma);
                    $('#animalGender').val(response.data.nem);
                    $('#animalId').val(response.data.id);
                    
                    $('#selectedAnimal').show();
                },
                error: function (response) {
                    console.log(response);

                    alert('An error occurred while fetching data.');
                }
            });
        }

        function updateAnimal() {
            $.ajax({
                url: '../backend/updateAnimal.php',
                method: 'POST',
                data: $('#updateForm').serialize(),
                success: function (response) {
                    $('#selectedAnimal').hide();
                    alert("Állat adatai sikeresen módosítva.");
                },
                error: function () {
                    
                }
            });
        }
    </script>




    <?php include_once "../components/footer/footer.php"; ?>



</body>

</html>