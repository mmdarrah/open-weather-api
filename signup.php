<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign up</title>
</head>
<body>

<main>
<h1>Open Weather API</h1>
<!-- Sign in form  seed the data to signup.inc.php-->
<div class="container">
<form action="includes/signup.inc.php" method="post">
<input type="text" name="userName" placeholder="Name" required >
<input type="password" name="password" placeholder="Password" required >
<input type="password" name="password_repeat" placeholder="Repeat password" required >
<button type="submit" name="signUp-submit">Sign up</button>
</form>
<a href="index.php">Back to login page</a>
</div>
</main>
</body>
</html>
