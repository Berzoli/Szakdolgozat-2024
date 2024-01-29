<?php require_once 'connection.php'; ?>

<?php

session_start();
$user_id = $_SESSION["userId"];
$usertype = $_SESSION["userType"];

if ($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["fajta"]) && isset($_POST["id"])) {
    $fajta = $_POST["fajta"];
    $id= $_POST["id"];

    $sql = "UPDATE users SET userType='$fajta' WHERE id=$id"; 
    $result = $conn->query($sql);

    if ($result === TRUE) {
        // Sikeres módosítás
        $response = array("status" => "success", "message" => "Profil sikeresen módosítva.");
        echo "fajta".$_POST["fajta"]."  id:".$_POST["id"];

    } else {
        // Hiba esetén
        $response = array("status" => "error", "message" => "Hiba történt a módosítás során: " . $conn->error);
    }

    
    $conn->close();

    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($usertype)) {

    if ($usertype == "1" || $usertype == "2") {
       
        if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["phone"])) {
            
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $phone = $_POST["phone"];
            $zipcode = $_POST["zipcode"];
            $city = $_POST["city"];


            $result = array(
                "firstname" => $firstname,
                "lastname" => $lastname,
                "phone" => $phone,
                "zipcode" => $zipcode,
                "city" => $city
            );

            $sql = "UPDATE users SET Firstname='$firstname', Lastname='$lastname', PhoneNumber='$phone', ZipCode='$zipcode', City='$city' WHERE id=$user_id"; // A WHERE feltétel módosítandó rekordot azonosítja
            $result = $conn->query($sql);

            if ($result === TRUE) {
                // Sikeres módosítás
                $response = array("status" => "success", "message" => "Profil sikeresen módosítva.");

                $_SESSION["ZipCode"] = $_POST["zipcode"];
                $_SESSION["City"] = $_POST["city"];
            } else {
                // Hiba esetén
                $response = array("status" => "error", "message" => "Hiba történt a módosítás során: " . $conn->error);
            }

           
            $conn->close();

            
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            
            header("HTTP/1.1 400 Bad Request");
            echo "Hiányzó mezők.";
        }
        
    }

    if ($usertype == "3") {
        
        if (isset($_POST["animalshelter"]) && isset($_POST["phone"])) {
            
            $animalshelter = $_POST["animalshelter"];
            $phone = $_POST["phone"];
            $zipcode = $_POST["zipcode"];
            $city = $_POST["city"];

            
            $result = array(
                "animalshelter" => $animalshelter,
                "phone" => $phone,
                "zipcode" => $zipcode,
                "city" => $city
            );

            $sql = "UPDATE users SET AnimalShelter='$animalshelter', PhoneNumber='$phone', ZipCode='$zipcode', City='$city' WHERE id=$user_id"; // A WHERE feltétel módosítandó rekordot azonosítja
            $result = $conn->query($sql);

            if ($result === TRUE) {
                // Sikeres módosítás
                $response = array("status" => "success", "message" => "Profil sikeresen módosítva.");
            } else {
                // Hiba esetén
                $response = array("status" => "error", "message" => "Hiba történt a módosítás során: " . $conn->error);
            }

           
            $conn->close();

            
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            
            header("HTTP/1.1 400 Bad Request");
            echo "Hiányzó mezők.";
        }
    }
}

else {
    
    header("HTTP/1.1 400 Bad Request");
    echo "Hibás kérés.";
}







?>