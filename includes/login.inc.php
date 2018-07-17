<?php

// starting the session
session_start();

if(isset($_POST['submit'])) {
    include 'dbh.inc.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Error handlers
    // Check if inputs are empty
    if(empty($username) || empty($password)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        // check if username exists in database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1) { // = no results
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if($row = mysqli_fetch_assoc($result)) { // Data gets inserted into row
                // De-hashing the password
                $hashedPwdCheck = password_verify($password, $row['password']); // checking if password is in db
                if($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif($hashedPwdCheck == true) {
                    // Log in the user here
                    $_SESSION['id'] = $row[id];
                    $_SESSION['first'] = $first[vorname];
                    $_SESSION['last'] = $last[nachname];
                    $_SESSION['email'] = $email[email];
                    $_SESSION['username'] = $username[username];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}