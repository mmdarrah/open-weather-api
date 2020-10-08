<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">

    <title>Document</title>
</head>
<body>
<div class="container">
<?php
session_start(); //start the session
// Check if the user clicked on the login button in the home page
if (isset($_POST['city-submit'])) {
    require 'dbh.inc.php'; // Database connection

    //SANITIZE data from user and put it in variables
    $city = filter_var($_POST['city'], FILTER_SANITIZE_SPECIAL_CHARS);
    //My personal key from open weather API
    $personalKey = ',se&units=metric&appid=094de54eaefc73af48abd522583f9e5a';
    echo '<p>Hi <span>' . $_SESSION['userName'] . '</span> you can add <span>' . $city . '</span> to your favorite by clicking the add button.</p>'; //Greeting message with concatenating of the username from session
    //The API request quntaine three part (url + city name + personal key)
    $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city . $personalKey;
    //Get the results in JSON
    $weather_json = @file_get_contents($url);
    if ($weather_json === false) {
        echo 'city not found';
    } else {
        //Put the Result in Array
        $weather_array = json_decode($weather_json, true);
        //Put the data in variables
        $temp = $weather_array['main']['temp'];
        //remove the decimals
        $temp = (int) $temp;
        $icon = $weather_array['weather'][0]['icon'];
        $description = $weather_array['weather'][0]['description'];
        $city = $weather_array['name'];
        $city = $weather_array['name'];
        //Show the card in HTML
        echo '<form action="favorite.inc.php" method="post">
        <div class="card">
                <img src="http://openweathermap.org/img/wn/' . $icon . '@2x.png" class="card-img-top" alt="Avatar"">
                <div class="container2">
                <h4><b>' . $city . '</b></h4>
                <h5><b>' . $description . '</b></h5>
                <p>' . $temp . '</p>
                </div>
                <input type="hidden" name="favCity" value="' . $city . '">
                <button type="submit" name="city">Add to favorites</button>
            </div>
            <a href="../index.php" >Back to home page</a>
            </form>';

    }

} else {
    header("Location: ../index.php"); //send back user to login page if the user went to the login.inc without pressing the submit button
    exit();
}
?>
</div>
</body>

</html>
