<?php
session_start();
session_destroy();

//send the user back to the login page
header('Location: docenten_login.php');
?>