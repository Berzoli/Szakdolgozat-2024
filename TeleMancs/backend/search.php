<?php

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

    echo $sql;

    require_once '../backend/connection.php';

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
        echo "<p>" . $row["leiras"] . "</p>";
        /* echo "Kor: " . $row["kor"] . "<br>";
        echo "Fajta: " . $row["fajta"] . "<br>";
        echo "Nem: " . $row["nem"] . "<br>";
        echo "Gondozás dátuma: " . $row["gondozasDatuma"] . "<br>";
        echo "Feltöltő telefonszáma: " . "<a href='tel:" . $row["PhoneNumber"] . "'>" . $row["PhoneNumber"] . "</a>" . "<br>";
        echo "Feltöltő email cím: " . $row["Email"] . "<br>"; */
        echo "<form action='allat.php' method='GET'>";
        echo "<input type='hidden' name='animal_id' value='" . $row["id"] . "'>";
        echo "<input type='submit' value='Megtekintés'>";
        echo "</form>";
        echo "</div>";



        echo "</div>";

        }
        } else {
        echo "Nincs találat az állatokra.";
        }

        // Adatbázis kapcsolat bezárása
        $conn->close();


?>

