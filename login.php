<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Check if the email exists
    $users = file_get_contents('users.txt');
    $users = json_decode($users, true);
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            if (password_verify($password, $user['password'])) {
                echo "Login successful.";
                exit();
            } else {
                echo "Invalid password.";
                exit();
            }
        }
    }

    echo "User not found. Please register or check your email.";
}
?>
