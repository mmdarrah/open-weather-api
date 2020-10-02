<?php

session_start(); //start the session

// Check if the user clicked on the login button in the home page
if (isset($_POST['city'])) {

    require 'dbh.inc.php'; // Database connection

    //Data from user
    $favCity = $_POST['favCity'];
    $userid = $_SESSION["userId"];
    $sql = "SELECT city FROM cities WHERE city =?"; //use placeholder for the prepare statement
    $stmt = mysqli_stmt_init($conn); //using prepare statement to prevent the user from send data directly to database to avoid sql injection
    if (!mysqli_stmt_prepare($stmt, $sql)) { // checking if the prepare statement has fail
        header("Location: ../signup.php?error=sqlError");
        exit();
    } else { // bind the prepare statment
        mysqli_stmt_bind_param($stmt, "s", $favCity);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $checkResult = mysqli_stmt_num_rows($stmt);
        if ($checkResult > 0) { // if the result is greater than 0 then there is a same username in the database
            header("Location: ./city.inc.php?error=cityExisted");
            exit();
        } else {
            $sql = "INSERT INTO cities (userid, city) VALUES ( ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) { // checking if the prepare statement has fail
                header("Location: ../signup.php?error=sqlError");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ss", $userid, $favCity);
                mysqli_stmt_execute($stmt);
                header("Location: ../index.php?signup=success");
                exit();
            }
        }

    }
} else {

    header("Location: ../index.php"); //send back user to login page if the user went to the login.inc without pressing the submit button
    exit();
}
