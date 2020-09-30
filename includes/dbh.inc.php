<?php

// Conent to database

// The database information
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "login";

// The database connection
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

// Cheking if the connection is not sucsess
if (!$conn){
// if the connection is not success the die function will kill the conection and throw an error message
  die("Connection faild: ".mysqli_conect_error());  
}

