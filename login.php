<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists
    $users = file_get_contents('users.txt');
    $users = json_decode($users, true);

    if ($users === null) {
        echo "Error reading user data.";
    } else {
        $authenticated = false;
        foreach ($users as $user) {
            if ($user['email'] == $email && password_verify($password, $user['password'])) {
                $authenticated = true;
                break;
            }
        }

        if ($authenticated) {
            // Redirect to a logged-in page
            header("Location: welcome.php");
            exit();
        } else {
            echo "Invalid email or password.";
        }
    }
}
?>
