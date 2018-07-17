<?php

if(isset($_POST['submit'])) { /*checks if the button 'submit' got clicked*/

    include_once 'dbh.inc.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']); /*first input in the signup form*/
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

    //Error handlers
    // Check for empty fields
    if(empty($first) || empty($last) || empty($email) || empty($username) || empty($pwd)) {
        header("Location: ../index.php?signup=empty");
        exit();
    } else {
        // check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            header("Location: ../index.php?signup=invalid");
            exit();
        } else {
            // check if email is valid
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../index.php?signup=email");
                exit();
            } else { // check for existing username
                   $sql = "SELECT * FROM users WHERE username='$username'";
                   $result = mysqli_query($conn, $sql);
                   $resultCheck = mysqli_num_rows($result);

                   if($resultCheck > 0) {
                       header("Location: ../index.php?signup=usertaken");
                       exit();
                   } else {
                       // Hashing the password (making it unrecognizable)
                       $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                       // insert the user into the database
                       $sql = "INSERT INTO users (vorname, nachname, email, username, password) VALUES ('$first', '$last', '$email', '$username', '$hashedPwd');";
                       // run the query on the database
                       mysqli_query($conn, $sql);
                       header("Location: ../index.php?signup=success");
                       exit();
                   }
            }
        }
    }

} else {
    header("Location: ../index.php");
    exit();
}