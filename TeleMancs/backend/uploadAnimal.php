<?php require_once 'connection.php'; ?>

<?php

    session_start();


    $nev = $_POST["nev"];
    $leiras = $_POST["leiras"];
    $kor = $_POST["kor"];
    $fajta = $_POST["fajta"];
    $nem = $_POST["nem"];
    $gondozasDatuma = $_POST["gondozasDatuma"];
    $userId = $_SESSION["userId"];




    // Az állatok táblába való beszúrás
    $sql = "INSERT INTO animals (nev, leiras, kor, fajta, nem, gondozasDatuma, userId) VALUES ('$nev', '$leiras', $kor, '$fajta', '$nem', '$gondozasDatuma', $userId)";
        

        
        $target_dir = "../animalImages/";
        $fileName = "telemancs" . time() . bin2hex(random_bytes(5));
        $uploadOk = 1;

        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $fileExtension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $target_file = $target_dir . $fileName . "." . $fileExtension;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "A fájl nem kép.";
                $uploadOk = 0;

                exit();
            }
        }


        if (file_exists($target_file)) {
            echo "A fájl már létezik.";
            $uploadOk = 0;

            exit();
        }


        if ($_FILES["image"]["size"] > 500000) {
            echo "A fájl mérete túl nagy.";
            $uploadOk = 0;

            exit();
        }


        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            echo "Csak JPG, JPEG, PNG és GIF fájlokat lehet feltölteni.";
            $uploadOk = 0;

            exit();
        }


        if ($uploadOk == 0) {
            echo "A fájl nem lett feltöltve.";
        } else {

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                $conn->query($sql);
                $last_inserted_animal_id = $conn->insert_id;

                $image_path = $target_file;
                $sql_image = "INSERT INTO images (animalID, image_path) VALUES ($last_inserted_animal_id, '$image_path')";
                $conn->query($sql_image);

                echo "Az állat és a kép sikeresen feltöltve.";
            } else {
                echo "Hiba történt a fájl feltöltése során.";
            }
        }

    $conn->close();
?>