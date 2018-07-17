<?php

// starting the session
session_start();

if(isset($_POST['submit'])) {
    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Error handlers
    // Check if inputs are empty
    if(empty($uid) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        // check if username exists in database
        $sql = "SELECT * FROM users WHERE user_uid='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1) { // = no results
            header("Location: ../index.php?login=error");
            exit();
        } else {
            if($row = mysqli_fetch_assoc($result)) { // Data gets inserted into row
                // De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']); // checking if pwd is in db
                if($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=error");
                    exit();
                } elseif($hashedPwdCheck == true) {
                    // Log in the user here
                    $_SESSION['u_id'] = $row[user_id];
                    $_SESSION['u_first'] = $first[user_first];
                    $_SESSION['u_last'] = $last[user_last];
                    $_SESSION['u_email'] = $email[user_email];
                    $_SESSION['u_uid'] = $uid[user_uid];
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