<?php
require_once '../backend/connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['animalId'])) {
    $animalId = $_POST['animalId'];

    
    if (!is_numeric($animalId)) {
        $response = array("status" => "error", "message" => "Invalid animal ID.");
    } else {
        
        $sql = "SELECT * FROM animals WHERE id = $animalId";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = array("status" => "success", "data" => $row, "message" => "Állat adatai sikeresen lekérdezve.");
        } else {
            $response = array("status" => "error", "message" => "Animal data not found.");
        }
    }
} else {
    
    $response = array("status" => "error", "message" => "Invalid r.");
}


header('Content-Type: application/json');
echo json_encode($response);


$conn->close();
?>