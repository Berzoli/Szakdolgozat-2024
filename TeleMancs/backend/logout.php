<?php

session_start();


if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    
    echo 'Logout successful.';
    
   
    session_destroy();

    
    header("Location: ../pages/index.php");
    exit();
} else {
    
    header("Location: ../pages/index.php");
    exit();
}
?>