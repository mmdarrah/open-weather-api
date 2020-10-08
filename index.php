<?php
//start the session if a user is signed in the user id will be in the session
//This way the app will now the state of the user
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Open Weather API</title>
</head>
<body>
<main>
<div class="container">
<?php
if (isset($_SESSION['userId'])) { //if the session contains a user id the user will be logged in
    echo '<form action="includes/logout.inc.php" method="post">
        <button type="submit" name="btn-logout">Logout</button>
        </form>';
    echo '<p>Hi <span>' . $_SESSION['userName'] . '</span> you are logged in</p>'; //Greeting message with concatenating of the username from session

    require './includes/dbh.inc.php'; // Database connection
    //Since the id saved in the session no need to SANITIZE it
    $userId = $_SESSION['userId'];
    // get the user favorites cites from the database
    $sql = "SELECT * FROM cities WHERE userid = $userId";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    //My personal key from open weather API
    $personalKey = ',se&units=metric&appid=094de54eaefc73af48abd522583f9e5a';
    // Check if the user had saved cites in favorite
    if ($resultCheck > 0) {
        echo '<div class="card-container">';
        while ($row = mysqli_fetch_assoc($result)) {
            //The API request quntaine three part (url + city name + personal key)
            $url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $row['city'] . $personalKey;
            //Get the results in JSON
            $weather_json = file_get_contents($url);
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
            echo '<form action="includes/delete.inc.php" method="post">
            <div class="card">
                    <img src="http://openweathermap.org/img/wn/' . $icon . '@2x.png" class="card-img-top" alt="Avatar"">
                    <div class="container2">
                    <h4><b>' . $city . '</b></h4>
                    <h5><b>' . $description . '</b></h5>
                    <p>' . $temp . '</p>
                    </div>
                    <input type="hidden" name="favCity" value="' . $city . '">
                    <button type="submit" name="delete">Delete</button>
                </div>
                </form>';
        }
        echo '</div>';
    }
    //Add city to get the weather
    echo '<form action="includes/city.inc.php" method="post">
            <label>Search for weather by your city name: </label></br>
            <input type="text" name="city" placeholder="City" required>
            <button type="submit" name="city-submit" >Submit</button>
        </form>';

} else { //if the session is empty the login form will appear
    echo '<form action="includes/login.inc.php" method="post">
        <input type="text" name="userName" placeholder="Name" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login-submit" >Login</button>
        </form>
        <a href="signup.php" >Sign up</a>';
    echo '<p>You are logged out</p>';
}
?>
</div>
</main>
</body>
</html>