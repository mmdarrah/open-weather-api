<?php
session_start();//start the session
// Check if the user clicked on the login button in the home page
if (isset($_POST['login-submit'])){

    require 'dbh.inc.php';// Database connection

    //Data from user
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    
    //get the user from database
    $sql= "SELECT * FROM users WHERE name =?";//using prepare statement to prevent the user from send data directly to database to avoid sql injection
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){// checking if the prepare statement has fail
        header("Location: ../index.php?error=sqlError");
        exit();
    } else {// bind the prepare statment
        mysqli_stmt_bind_param($stmt, "s", $userName);//use placeholder for the prepare statement
        mysqli_stmt_execute($stmt);//using prepare statement to prevent the user from send data directly to database to avoid sql injection
        $result = mysqli_stmt_get_result($stmt);//store the result to check the password if matches
        if($row = mysqli_fetch_assoc($result)){
            $passowrdCheck = password_verify($password, $row['password']);
            if($passowrdCheck == false){
                header("Location: ../index.php?error=wrongPass");
                exit();
            }else if ($passowrdCheck == true){//store the username and the id in the session(super global)
                session_start();
                $_SESSION['userId'] = $row['id'];
                $_SESSION['userName'] = $row['name'];
                header("Location: ../index.php?login=success");
                exit();
            }else{
                header("Location: ../index.php?error=wrongPass");//send back user to login page
                exit();
            }
        }else {
            header("Location: ../index.php?error=noUser");//send back user to login page
            exit();  
        }
        
} }else {
    header("Location: ../index.php");//send back user to login page if the user went to the login.inc without pressing the submit button
    exit();
}