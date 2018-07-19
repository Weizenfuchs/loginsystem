<?php

// starting the session
session_start();

if(isset($_POST['submit'])) {

    $username = mysqli_real_escape_string(Database::getConnection(), $_POST['username']);
    $password = mysqli_real_escape_string(Database::getConnection(), $_POST['password']);

    // Error handlers
    // Check if inputs are empty
    if(empty($username) || empty($password)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $user = new User();
        $user = $user->load($username, $password);
        // check if username exists in database
        if($user == null) {
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if($row = mysqli_fetch_assoc($result)) { // Data gets inserted into row
                // verifying the hashed password
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
                    // User successfully logged in
                    $_SESSION["login"] = true;
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