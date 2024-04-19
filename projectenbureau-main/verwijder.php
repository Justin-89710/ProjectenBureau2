<?php
require "connection.php";
global $conn;

// get name from url
$projectNaam = $_GET["id"];

//delete project
$sql = "DELETE FROM Projecten WHERE ProjectNaam = '$projectNaam'";
$conn->query($sql);

header('Location: projecten.php');
?>