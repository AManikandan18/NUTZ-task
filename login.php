<?php
session_start(); // Start session for storing user information

require_once 'database.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    // Get username and password from the form
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs (you may want to add more validation as per your requirements)
    if (!empty($username) && !empty($password)) {
        // Prepare and execute the query
        $query = "SELECT username, password, post FROM login WHERE username = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // Bind result variables
                $stmt->bind_result($username, $hashedPassword, $post);
                if ($stmt->fetch()) {
                    // Verify password
                    if (password_verify($password, $hashedPassword)) {
                        // Password is correct, store user data in session
                        $_SESSION['username'] = $username;
                        $_SESSION['post'] = $post;

                        // Redirect to a secure page or display a success message
                        echo "<script>alert('Login Successful'); window.location.href='dashboard.php';</script>";
                    } else {
                        // Password is incorrect
                        echo "<script>alert('Incorrect password'); window.location.href='login.html';</script>";
                    }
                }
            } else {
                // Username not found
                echo "<script>alert('Username not found'); window.location.href='login.html';</script>";
            }

            $stmt->close();
        } else {
            // Error preparing statement
            echo "<script>alert('Database error'); window.location.href='login.html';</script>";
        }
    } else {
        // Empty username or password
        echo "<script>alert('Please enter username and password'); window.location.href='login.html';</script>";
    }

    $conn->close();
}
?>
