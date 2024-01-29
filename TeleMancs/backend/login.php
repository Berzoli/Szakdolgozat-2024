<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $enteredEmail = isset($_POST['email']) ? $_POST['email'] : '';
    $enteredPassword = isset($_POST['password']) ? $_POST['password'] : '';

    
    if (empty($enteredEmail) || empty($enteredPassword)) {
        echo 'Please enter both email and password.';
    } else {
        
        $stmt = $conn->prepare('SELECT id, userType, email, firstname, lastname, phoneNumber, City, ZipCode, password FROM users WHERE email = ?');
        $stmt->bind_param('s', $enteredEmail);
        $stmt->execute();
        $stmt->bind_result($userId, $userType, $email, $firstname, $lastname, $phoneNumber, $city, $zipcode, $hashedPassword);
        $stmt->fetch();

        
        if ($hashedPassword && password_verify($enteredPassword, $hashedPassword)) {
            
            session_start();

            
            $_SESSION['loggedIn'] = true;
            $_SESSION['userId'] = $userId;
            $_SESSION['userType'] = $userType;
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['phoneNumber'] = $phoneNumber;
            $_SESSION['City'] = $city;
            $_SESSION['ZipCode'] = $zipcode;

           
            echo 'Login successful.';

           
            header("Location: ../pages/index");
            exit(); 
        } else {
           
            echo 'Invalid email or password.';
        }

        $stmt->close();
    }
}

$conn->close();
?>