<?php
//start the session
session_start();
//end the session
session_unset();
session_destroy();
header("Location: ../index.php");//send the user to the homepage