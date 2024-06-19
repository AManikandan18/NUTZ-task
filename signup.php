<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {

    // Basic input validation and sanitization
    $username = trim($_POST['usernameText']);
    $password = trim($_POST['passwordText']);

    // Check if the inputs are not empty
    if (!empty($username) && !empty($password)) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the query to insert into 'signup' table
        $query_signup = "INSERT INTO signup (username, password) VALUES (?, ?)";
        if ($stmt_signup = $conn->prepare($query_signup)) {
            $stmt_signup->bind_param("ss", $username, $hashedPassword);

            if ($stmt_signup->execute()) {
                // Insert into 'login' table after successful signup
                $query_login = "INSERT INTO login (username, password) VALUES (?, ?)";
                if ($stmt_login = $conn->prepare($query_login)) {
                    $stmt_login->bind_param("ss", $username, $hashedPassword);

                    if ($stmt_login->execute()) {
                        echo "<script>alert('Account Created'); window.location.href='login.html';</script>";
                    } else {
                        echo "<script>alert('Error creating account in login table'); window.location.href='signup.html';</script>";
                    }

                    $stmt_login->close();
                } else {
                    echo "<script>alert('Error preparing statement for login table'); window.location.href='signup.html';</script>";
                }
            } else {
                echo "<script>alert('Error creating account'); window.location.href='signup.html';</script>";
            }

            $stmt_signup->close();
        } else {
            echo "<script>alert('Error preparing statement for signup table'); window.location.href='signup.html';</script>";
        }
    } else {
        echo "<script>alert('Username and Password cannot be empty'); window.location.href='signup.html';</script>";
    }

    $conn->close();
}
?>
