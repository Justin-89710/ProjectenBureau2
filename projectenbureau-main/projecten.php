<?php
require_once "connection.php";
global $conn;

session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['email']) || strpos($_SESSION['email'], '@glr') === false) {
    header('Location: docenten_login.php');
    exit();
}
// show all in projecten tabel
$sql = "SELECT * FROM Projecten";
$result = $conn->query($sql);

//echo result
if ($result->num_rows > 0) {
    echo "<table class='table table-striped'><tr><th>ProjectNaam</th><th>ProjectBeschrijving</th><th>HTML</th><th>CSS</th><th>JS</th><th>PHP</th><th>Startdatum</th><th>Einddatum</th><th>Status</th><th>afbeelding</th><th>aanpassen</th><th>Wat will?</th><th>Verwijder</th></tr>";
    while ($row = $result->fetch_assoc()) {
        // Convert "BULL" to "Ja" and anything else to "Nee"
        $html = ($row["HTML"] == "BULL") ? "Ja" : "Nee";
        $css = ($row["CSS"] == "BULL") ? "Ja" : "Nee";
        $js = ($row["JS"] == "BULL") ? "Ja" : "Nee";
        $php = ($row["PHP"] == "BULL") ? "Ja" : "Nee";

        echo "<tr><td>" . $row["ProjectNaam"] . "</td><td>" . $row["ProjectBeschrijving"] . "</td><td>" . $html . "</td><td>" . $css . "</td><td>" . $js . "</td><td>" . $php . "</td><td>" . $row["Startdatum"] . "</td><td>" . $row["Einddatum"] . "</td><td>" . $row["Status"] . "</td><td><img src='media/" . $row["Afbeelding"] . "' ></td><td>" . $row["watwil"] . "</td><td><a href='aanpassen.php?id=" . $row["ProjectNaam"] . "'><button>aanpassen</button></a></td><td><a href='verwijder.php?id=" . $row["ProjectNaam"] . "'><button>verwijderen</button></a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
