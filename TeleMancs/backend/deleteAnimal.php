<?php
include('connection.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_animal'])) {

    if (isset($_POST['delete'])) {
        
        $animalID = $_POST['delete_animal'];

    
    mysqli_begin_transaction($conn);

    try {
        
        $getImagesQuery = "SELECT image_path FROM images WHERE animalID = $animalID";
        $result = mysqli_query($conn, $getImagesQuery);

        
        while ($row = mysqli_fetch_assoc($result)) {
            $imagePath = $row['image_path'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        
        $deleteImagesQuery = "DELETE FROM images WHERE animalID = $animalID";
        mysqli_query($conn, $deleteImagesQuery);

        
        $deleteAnimalQuery = "DELETE FROM animals WHERE id = $animalID";
        mysqli_query($conn, $deleteAnimalQuery);

        
        mysqli_commit($conn);

        echo "Animal and associated images successfully deleted.";
        } catch (Exception $e) {
           
            mysqli_rollback($conn);

            echo "Error deleting animal: " . $e->getMessage();
        }

        
         mysqli_close($conn);
        }

        if (isset($_POST['removeAlert'])) {
            $animalID = $_POST['delete_animal'];
            $sql = "UPDATE animals SET alert = 0 WHERE id = $animalID";
            mysqli_query($conn, $sql);
        }



    }

    

    
    mysqli_close($conn);



?>