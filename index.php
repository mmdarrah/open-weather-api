<?php
session_start(); //start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- bootstrap for basic style -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Login system</title>
</head>
<body>
<main>

<h1>Login system by <span>Mohammed Darrah</span></h1>

<div class="container">
<?php
if (isset($_SESSION['userId'])) { //if the session contains a user id the user will be logged in
    echo '<form action="includes/logout.inc.php" method="post">
        <button type="submit" name="btn-logout" class="btn btn-danger btn2">Logout</button>
        </form>';
    echo '<p>Hi <span>' . $_SESSION['userName'] . '</span> you are logged in</p>'; //Greeting message with concatenating of the username from session

    $url = 'http://api.openweathermap.org/data/2.5/weather?q=Stockholm,se&units=metric&appid=094de54eaefc73af48abd522583f9e5a';
    $weather_json = file_get_contents($url);
    $weather_array = json_decode($weather_json, true);
    echo $weather_array['main']['temp'];
    $icon = $weather_array['weather'][0]['icon'];

    echo '<img src="http://openweathermap.org/img/wn/' . $icon . '@2x.png"> ';

} else { //if the session is empty the login form will appear
    echo '<form action="includes/login.inc.php" method="post" class="form-group">
        <input type="text" name="userName" placeholder="Name" class="form-control">
        <input type="password" name="password" placeholder="Password" class="form-control">
        <button type="submit" name="login-submit" class="btn btn-primary">Login</button>
        </form>
        <a href="signup.php" class="btn btn-success">Sign up</a>';
    echo '<p>You are logged out</p>';
}
?>
</div>
</main>
<!-- bootstrap script for basic style -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>