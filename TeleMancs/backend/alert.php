<?php
require_once 'connection.php';

echo "animalId: " . $_POST['animalId'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['animalId'])) {
    $animalId = $_POST['animalId'];

    // SQL lekérdezés az állat "Alert" értékének frissítéséhez
    $updateSql = "UPDATE animals SET Alert = 1 WHERE id = $animalId";
    $updateResult = $conn->query($updateSql);

    if ($updateResult === TRUE) {
        echo "Az állat sikeresen jelentve.";
    } else {
        echo "Hiba történt az állat jelentése során: " . $conn->error;
    }
} else {
    echo "Nincs érvényes kérés.";
}

$conn->close();
?>