<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validate email and password (you may add more validation here)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit();
    }
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit();
    }

    // Check if the email already exists
    $users = file_get_contents('users.txt');
    $users = json_decode($users, true);
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            echo "Email already registered. Please login or use a different email.";
            exit();
        }
    }

    // Add user to the list
    $users[] = ['email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)];
    file_put_contents('users.txt', json_encode($users));

    echo "User registered successfully.";
}
?>
