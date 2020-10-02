<?php

session_start(); //start the session

// Check if the user clicked on the login button in the home page
if (isset($_POST['delete'])) {

    require 'dbh.inc.php'; // Database connection

    //Data from user
    $favCity = $_POST['favCity'];
    $userid = $_SESSION["userId"];

    $sql = "DELETE FROM cities Where city = '$favCity' AND userid = '$userid'";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header("Location: ../index.php?delete=success");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {

    header("Location: ../index.php"); //send back user to login page if the user went to the login.inc without pressing the submit button
    exit();
}
