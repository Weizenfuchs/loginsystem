<?php


if(isset($_POST['submit'])) { /*checks if the button 'submit' got clicked*/

    $first = mysqli_real_escape_string(Database::getConnection(), $_POST['first']); /*first input in the signup form*/
    $last = mysqli_real_escape_string(Database::getConnection(), $_POST['last']);
    $email = mysqli_real_escape_string(Database::getConnection(), $_POST['email']);
    $username = mysqli_real_escape_string(Database::getConnection(), $_POST['username']);
    $password = mysqli_real_escape_string(Database::getConnection(), $_POST['password']);

    $location = "Location: ../signup.php";

    //Error handlers
    // Check for empty fields
    if(empty($first) || empty($last) || empty($email) || empty($username) || empty($password)) {
        $location .= "?signup=empty";
    } else {
        // check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)) {
            $location .= "?signup=invalid";
        } else {
            // check if email is valid
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $location .= "?signup=email";
            } else {
                $user = new User();
                $userCheck = $user->create($first, $last, $email, $username, $password);

                // true if user got created
                if($userCheck) {
                    $location = "Location: ../index.php?signup=success";
                } else {
                    $location .= "?signup=usertaken";
                }
            }
        }
    }
    header($location);
    exit();
}