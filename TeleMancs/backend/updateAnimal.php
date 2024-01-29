<?php
require_once '../backend/connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['animalId']) && isset($_POST['animalName']) && isset($_POST['animalDescription'])  && isset($_POST['animalAge'])  && isset($_POST['animalGender'])  && isset($_POST['animalDate']) && isset($_POST['animalType'])) {

    $animalId = $_POST['animalId'];
    $animalName = $_POST['animalName'];
    $animalDescription = $_POST['animalDescription'];
    $animalAge = $_POST['animalAge'];
    $animalGender = $_POST['animalGender'];
    $animalDate = $_POST['animalDate'];
    $animalType = $_POST['animalType'];

    echo 'animalId:'.$animalId.'<br>'. 'animalName:'.$animalName. '<br>'. 'animalDescription:'.$animalDescription. '<br>'. 'animalAge:'.$animalAge. '<br>'. 'animalGender:'.$animalGender. '<br>'. 'animalDate:'.$animalDate. '<br>'. 'animalType:'.$animalType. '<br>';

    $sql = "UPDATE animals SET nev = '$animalName', leiras = '$animalDescription', kor = '$animalAge', nem = '$animalGender', gondozasDatuma = '$animalDate', fajta = '$animalType' WHERE id = $animalId";

    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Állat adatai sikeresen frissítve.");
    } else {
        $response = array("status" => "error", "message" => "Hiba történt az állat adatainak frissítése során: " . $conn->error);
    }

    // JSON válasz küldése
    header('Content-Type: application/json');
    echo json_encode($response);

    $conn->close();
} else {
    
    $response = array("status" => "error", "message" => "Érvénytelen kérés.");
    echo json_encode($response);
}
?>