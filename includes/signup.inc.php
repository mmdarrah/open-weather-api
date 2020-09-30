<?php
session_start();//start the session
// Check if the user clicked on the signup button in the home page
if (isset($_POST['signUp-submit'])){

    require 'dbh.inc.php';// Database connection

    //Data from user
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password_repeat'];

    // Check if the passwords dont match
    if ( $password !== $password_repeat ){
        header("Location: ../signup.php?error=passwordDontMatch&userName=".$userName);
        exit();// Stop other code from working if the user left empty fields
    } else {// Check if the username is already exist in the database
        
        // Connecting to the database to check if the user name is alrady exist
        $sql= "SELECT name FROM users WHERE name =?";//use placeholder for the prepare statement
        $stmt = mysqli_stmt_init($conn);//using prepare statement to prevent the user from send data directly to database to avoid sql injection
        if(!mysqli_stmt_prepare($stmt, $sql)){// checking if the prepare statement has fail
            header("Location: ../signup.php?error=sqlError");
            exit();
        } else {// bind the prepare statment
            mysqli_stmt_bind_param($stmt, "s", $userName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $checkResult = mysqli_stmt_num_rows($stmt);
            if ($checkResult > 0){ // if the result is greater than 0 then there is a same username in the database
                header("Location: ../signup.php?error=usertaken");
                exit(); 
            }else{
                $sql= "INSERT INTO users (name, password) VALUES ( ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){// checking if the prepare statement has fail
                    header("Location: ../signup.php?error=sqlError");
                    exit();
            } else {
                // hashing the password so the password will be hashed in the database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);// The default algorithm it will use the stronger hashing algorithms are supported.
                mysqli_stmt_bind_param($stmt, "ss", $userName, $hashedPassword);
                mysqli_stmt_execute($stmt);
                header("Location: ../index.php?signup=success");
                exit();
            }
        }
    }
}
}else {
        header("Location: ../signup.php");//send back user to login page if the user went to the signup.inc without pressing the submit button
        exit();

}