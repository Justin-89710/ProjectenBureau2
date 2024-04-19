<?php
// show server errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include the database connection
require_once "connection.php";
global $conn;

//check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //get the username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if the username and password are correct
    $sql = "SELECT * FROM Docenten WHERE DocentenEmail = '$username' AND wachtwoord = '$password'";
    $result = $conn->query($sql);

    //if the query returns a row, the username and password are correct
    if ($result->num_rows > 0) {
        //start a session
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $username;
        echo "Login successful";
        header("Location: projectentoevoegen.php");
    } else {
        echo "Login failed";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
    <title>Docenten login</title>
</head>
<body>

    <h1>Docenten Login</h1>
<!-- absic form met username en password -->
<form method="post">
    <label for="username">Gebruikersnaam:</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Wachtwoord:</label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Inloggen">
</form>
</body>
</html>
