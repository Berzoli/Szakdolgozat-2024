<?php require_once '../connection.php'; ?>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userType = "3";
    $animalshelter = isset($_POST['animalshelter']) ? $_POST['animalshelter'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($animalshelter) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        echo 'Please fill in all fields.';
    } elseif ($password !== $confirmPassword) {
        echo 'Passwords do not match.';
    } else {
        $stmt = $conn->prepare('SELECT id, Password FROM users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo 'Email is already registered.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare('INSERT INTO users (userType, AnimalShelter, Email, PhoneNumber, Password) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('sssss', $userType, $animalshelter, $email, $phone, $hashedPassword);
            $stmt->execute();

            $userId = $stmt->insert_id;

           
            echo '
                <form id="redirectForm" action="../login.php" method="post">
                    <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
                    <input type="hidden" name="password" value="' . htmlspecialchars($password) . '">
                </form>
                <script>
                    document.getElementById("redirectForm").submit();
                </script>
            ';

            exit();
        }

        $stmt->close();
    }
}

$conn->close();
?>
