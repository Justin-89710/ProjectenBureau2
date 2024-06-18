<?php
// require_once "connection.php";
// global $conn;

// session_start();

// if (!isset($_SESSION['loggedin']) || !isset($_SESSION['email']) || strpos($_SESSION['email'], '@glr') === false) {
//     header('Location: docenten_login.php');
//     exit();
// }
// // show all in projecten tabel
// $sql = "SELECT * FROM Projecten";
// $result = $conn->query($sql);

// //echo result
// if ($result->num_rows > 0) {
//     echo "<table class='table table-striped'><tr><th>ProjectNaam</th><th>ProjectBeschrijving</th><th>HTML</th><th>CSS</th><th>JS</th><th>PHP</th><th>Startdatum</th><th>Einddatum</th><th>Status</th><th>afbeelding</th><th>aanpassen</th><th>Wat will?</th><th>Verwijder</th></tr>";
//     while ($row = $result->fetch_assoc()) {
//         // Convert "BULL" to "Ja" and anything else to "Nee"
//         $html = ($row["HTML"] == "BULL") ? "Ja" : "Nee";
//         $css = ($row["CSS"] == "BULL") ? "Ja" : "Nee";
//         $js = ($row["JS"] == "BULL") ? "Ja" : "Nee";
//         $php = ($row["PHP"] == "BULL") ? "Ja" : "Nee";

//         echo "<tr><td>" . $row["ProjectNaam"] . "</td><td>" . $row["ProjectBeschrijving"] . "</td><td>" . $html . "</td><td>" . $css . "</td><td>" . $js . "</td><td>" . $php . "</td><td>" . $row["Startdatum"] . "</td><td>" . $row["Einddatum"] . "</td><td>" . $row["Status"] . "</td><td><img src='media/" . $row["Afbeelding"] . "' ></td><td>" . $row["watwil"] . "</td><td><a href='aanpassen.php?id=" . $row["ProjectNaam"] . "'><button>aanpassen</button></a></td><td><a href='verwijder.php?id=" . $row["ProjectNaam"] . "'><button>verwijderen</button></a></td></tr>";
//     }
//     echo "</table>";
// } else {
//     echo "0 results";
// }

// $conn->close();
?>
<!-- 
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href='projectentoevoegen.php.php'><button class='btn btn-primary mt-3'>voeg een project toe!</button></a>
</body>
</html> -->


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projecten</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
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
    echo "<table><tr><th>ProjectNaam</th><th>ProjectBeschrijving</th><th>HTML</th><th>CSS</th><th>JS</th><th>PHP</th><th>over</th><th>Startdatum</th><th>Einddatum</th><th>Status</th><th>afbeelding</th><th>Wat will?</th><th>qr</th><th>aanpassen</th><th>Verwijder</th></tr>";
    while ($row = $result->fetch_assoc()) {
        // Convert "BULL" to "Ja" and anything else to "Nee"
        $html = ($row["HTML"] == "BULL") ? "Ja" : "Nee";
        $css = ($row["CSS"] == "BULL") ? "Ja" : "Nee";
        $js = ($row["JS"] == "BULL") ? "Ja" : "Nee";
        $php = ($row["PHP"] == "BULL") ? "Ja" : "Nee";
        $over = ($row["overeg"] == "BULL") ? "Ja" : "Nee";

        echo "<tr><td>" . $row["ProjectNaam"] . "</td><td>" . $row["ProjectBeschrijving"] . "</td><td>" . $html . "</td><td>" . $css . "</td><td>" . $js . "</td><td>" . $php . "</td><td>" . $over . "</td><td>" . $row["Startdatum"] . "</td><td>" . $row["Einddatum"] . "</td><td>" . $row["Status"] . "</td><td><img src='media/" . $row["Afbeelding"] . "' ></td><td>" . $row["watwil"] . "</td><td><img src='" . $row["QR"] . "' alt='gfd'></td><td><a href='aanpassen.php?id=" . $row["ProjectNaam"] . "'><button>aanpassen</button></a></td><td><a href='verwijder.php?id=" . $row["ProjectNaam"] . "'><button>verwijderen</button></a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<a href='projectentoevoegen.php'><button class='btn btn-primary mt-3'>voeg een project toe!</button></a>
</body>
</html>
