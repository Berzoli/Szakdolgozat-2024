<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keresés</title>
    <link rel="stylesheet" href="../components/header/header.css">
    <link rel="stylesheet" href="../components/footer/footer.css">

    <style>
        body {
            background-color: #f8f8f8;
        }
        #animalCard {
            width: 300px;
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);
            margin: 20px;
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
        }
        #animalCard img {
            margin: auto;
            display: flex;
            aspect-ratio: 16 / 9;
            width: 100%;
            object-fit: cover;

        }
        #animalInfo {
            padding: 0 20px 10px 20px;
        }

        #animalInfo p {
            margin: 20px 0 20px 0;
        }

        #animalInfo h3 {
            font-size: 30px;
        }

        #animalInfo input[type="submit"] {
            border: none;
            background-color: #1B80F1;
            padding: 15px;
            font-size: 16px;
            color: white;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s ease;
        }
        #animalInfo input[type="submit"]:hover {
            background-color: #0059B2;
            position: relative;
            bottom: 0;
        }

        #animalImage {
            height: 200px;
            width: 300px;
        }

        #animalInfo p:nth-child(2) {
            text-align: justify;
        }

        #cardContainer {
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 80%;
            max-width: 1200px;
        }

       
        #search {
            background-color: lightgray;
            padding: 20px;
        }

    </style>

</head>
<body>
    <?php include_once "../components/header/header.php"; ?>
    <?php include_once "../backend/connection.php"; ?>

    <!-- SZŰRÉRS -->

    <div id="search">
        <div id="searchBar">
            <form action="" method="GET">
                <label for="searchGender">Nem</label>
                    <select name="searchGender" id="searchGender">
                        <option value="">Mindegy</option>
                        <option value="Hím">Hím</option>
                        <option value="Nőstény">Nőstény</option>
                    </select>
                <label for="searchInput">Kulcsszó</label>
                    <input type="text" id="searchInput" placeholder="Keresés">
                <label for="searchInput">userType</label>
                    <select name="searchUserType" id="searchUserType">
                        <option value="">Mind</option>
                        <option value="1">Magánszemély</option>
                        <option value="2">Ideiglenes befogadó</option>
                        <option value="3">Menhely</option>
                    </select>
                <label for="searchAge">Kor</label>
                    <select name="searchAge" id="searchAge">
                        <option value="">Mindegy</option>
                        <option value="Kölyök">Kölyök</option>
                        <option value="Felnőtt">Felnőtt</option>
                    </select>
                <label for="">Terület...</label>
                <input type="submit" value="Keresés">
            </form>  
        </div>
    </div>

    

    <div id="cardContainer">
        

        <?php

        $sql = "";


        if ((!isset($_GET["searchGender"]) || $_GET["searchGender"] == "") && (!isset($_GET["searchAge"]) || $_GET["searchAge"] == "") && (!isset($_GET["searchInput"]) || $_GET["searchInput"] == "") && (!isset($_GET["searchUserType"]) || $_GET["searchUserType"] == "")) {
            $sql = "SELECT a.*, u.PhoneNumber, u.Email, i.image_path FROM animals a
            LEFT JOIN users u ON a.userId = u.id
            LEFT JOIN images i ON a.id = i.animalID";

        }
        
        else {
            $query = "";

            if (isset($_GET['searchGender']) && $_GET['searchGender'] != '') {
            
                if ($query == "") {
                    $query = "nem = '" . $_GET['searchGender'] . "'";
                }
                else {
                    $query = $query . " AND nem = '" . $_GET['searchGender'] . "'";
                }
            
               
            }
            
            if (isset($_GET['searchUserType']) && $_GET['searchUserType'] != '') {
            
                if ($query == "") {
                    $query = "userType = '" . $_GET['searchUserType'] . "'";
                }
                else {
                    $query = $query . " AND userType = '" . $_GET['searchUserType'] . "'";
                }
            }
            
            if (isset($_GET['searchAge']) && $_GET['searchAge'] != '') {
            
                if ($query == "" && $_GET['searchAge'] == 'Kölyök') {
                    $query = "kor < 3";
                }
                elseif ($query == "" && $_GET['searchAge'] == 'Felnőtt') {
                    $query = "kor > 2";
                }
                elseif ($query != "" && $_GET['searchAge'] == 'Kölyök') {
                    $query = $query . " AND kor < 3 ";
                }
                elseif ($query != "" && $_GET['searchAge'] == 'Felnőtt') {
                    $query = $query . " AND kor > 2 ";
                }
            }
            
            
                if ($query != "") {
                
                $sql = "SELECT a.*, u.PhoneNumber, u.Email, i.image_path FROM animals a
                LEFT JOIN users u ON a.userId = u.id
                LEFT JOIN images i ON a.id = i.animalID WHERE " . $query; 
                
            }
                else {
                
                $sql = "SELECT a.*, u.PhoneNumber, u.Email, i.image_path FROM animals a
                LEFT JOIN users u ON a.userId = u.id
                LEFT JOIN images i ON a.id = i.animalID";
                
            }

            }


        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        echo "<div id='animalCard'>";
        echo "<div id='animalImage'>";

        if (!empty($row["image_path"])) {
            echo '<img src="' . $row["image_path"] . '" alt="Állat képe" width="200"><br>';
        }

        echo "</div>";
        echo "<div id='animalInfo'>";
        echo "<h3>" . $row["nev"] . "</h3>";
        echo "<p>" . $row["fajta"] . "</p>";
        /* echo "Kor: " . $row["kor"] . "<br>";
        echo "Fajta: " . $row["fajta"] . "<br>";
        echo "Nem: " . $row["nem"] . "<br>";
        echo "Gondozás dátuma: " . $row["gondozasDatuma"] . "<br>";
        echo "Feltöltő telefonszáma: " . "<a href='tel:" . $row["PhoneNumber"] . "'>" . $row["PhoneNumber"] . "</a>" . "<br>";
        echo "Feltöltő email cím: " . $row["Email"] . "<br>"; */
        echo "<form action='allat' method='GET'>";
        echo "<input type='hidden' name='animal_id' value='" . $row["id"] . "'>";
        echo "<input type='submit' value='Megtekintés'>";
        echo "</form>";
        echo "</div>";



        echo "</div>";

        }
        } else {
        echo "Nincs találat az állatokra.";
        }

       
        $conn->close();
        ?>
    </div>


    

    <?php include_once "../components/footer/footer.php"; ?>
</body>
</html>