<?php
// get info from database
require_once "connection.php";
global $conn;

// get name from url
$projectNaam = $_GET["id"];

// post name
if (isset($_POST["naam"])) {
    $projectnaam = $_POST["projectnaam"];
    $sql = "UPDATE Projecten SET ProjectNaam = '$projectnaam' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post beschrijving
if (isset($_POST["beschrijving"])) {
    $beschrijving = $_POST["projectbeschrijving"];
    $sql = "UPDATE Projecten SET ProjectBeschrijving = '$beschrijving' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post html
if (isset($_POST["htmlbull"])) {
    $html = "BULL";
    $sql = "UPDATE Projecten SET HTML = '$html' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
if (isset($_POST["htmlbear"])) {
    $html = "BEAR";
    $sql = "UPDATE Projecten SET HTML = '$html' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post css
if (isset($_POST["cssbull"])) {
    $css = "BULL";
    $sql = "UPDATE Projecten SET CSS = '$css' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
if (isset($_POST["cssbear"])) {
    $css = "BEAR";
    $sql = "UPDATE Projecten SET CSS = '$css' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post js
if (isset($_POST["jsbull"])) {
    $js = "BULL";
    $sql = "UPDATE Projecten SET JS = '$js' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
if (isset($_POST["jsbear"])) {
    $js = "BEAR";
    $sql = "UPDATE Projecten SET JS = '$js' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post php
if (isset($_POST["phpbull"])) {
    $php = "BULL";
    $sql = "UPDATE Projecten SET PHP = '$php' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
if (isset($_POST["phpbear"])) {
    $php = "BEAR";
    $sql = "UPDATE Projecten SET PHP = '$php' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}


// post startdatum
if (isset($_POST["start"])) {
    $startdatum = $_POST["startdatum"];
    $sql = "UPDATE Projecten SET Startdatum = '$startdatum' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post einddatum
if (isset($_POST["eind"])) {
    $einddatum = $_POST["einddatum"];
    $sql = "UPDATE Projecten SET Einddatum = '$einddatum' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}
// post status
if (isset($_POST["status"])) {
    $status = $_POST["status"];
    $sql = "UPDATE Projecten SET Status = '$status' WHERE ProjectNaam = '$projectNaam'";
    $conn->query($sql);
}

// get info from database
$sql = "SELECT * FROM Projecten WHERE ProjectNaam = '$projectNaam'";

$result = $conn->query($sql);

//make for every item a input field and a form to edit
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<form method='post'>";
        echo "<input type='hidden' name='projectnaam' value='" . $row["ProjectNaam"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='projectnaam'>Project Naam:</label>";
        echo "<input type='text' class='form-control' id='projectnaam' name='projectnaam' value='" . $row["ProjectNaam"] . "' required>";
        echo "<button type='submit' name='naam' class='btn btn-primary mt-3'>Opslaan</button>";
        echo "</div>";
        echo "</form>";
        //form for project beschrijving
        echo "<form method='post'>";
        echo "<input type='hidden' name='projectbeschrijving' value='" . $row["ProjectBeschrijving"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='projectbeschrijving'>Project Beschrijving:</label>";
        echo "<textarea class='form-control' id='projectbeschrijving' name='projectbeschrijving' rows='3' required>" . $row["ProjectBeschrijving"] . "</textarea>";
        echo "<button type='submit' name='beschrijving' class='btn btn-primary mt-3'>Opslaan</button>";
        echo "</div>";
        echo "</form>";
        //form for html
        // button ot turn html to bull
        echo "<form method='post'>";
        echo "<input type='hidden' name='html' value='" . $row["HTML"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='html'>HTML:</label>";
        echo "<button type='submit' name='htmlbull' class='btn btn-primary mt-3'>BULL</button>";
        echo "</div>";
        echo "</form>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='html' value='" . $row["HTML"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='html'>HTML:</label>";
        echo "<button type='submit' name='htmlbear' class='btn btn-primary mt-3'>BEAR</button>";
        echo "</div>";
        echo "</form>";
        //form for css
        // button ot turn css to bull
        echo "<form method='post'>";
        echo "<input type='hidden' name='css' value='" . $row["CSS"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='css'>CSS:</label>";
        echo "<button type='submit' name='cssbull' class='btn btn-primary mt-3'>BULL</button>";
        echo "</div>";
        echo "</form>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='css' value='" . $row["CSS"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='css'>CSS:</label>";
        echo "<button type='submit' name='cssbear' class='btn btn-primary mt-3'>BEAR</button>";
        echo "</div>";
        echo "</form>";
        //form for js
        // button ot turn js to bull
        echo "<form method='post'>";
        echo "<input type='hidden' name='js' value='" . $row["JS"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='js'>JS:</label>";
        echo "<button type='submit' name='jsbull' class='btn btn-primary mt-3'>BULL</button>";
        echo "</div>";
        echo "</form>";
        echo "<form method='post'>";
        echo "<input type='hidden' name='js' value='" . $row["JS"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='js'>JS:</label>";
        echo "<button type='submit' name='jsbear' class='btn btn-primary mt-3'>BEAR</button>";
        echo "</div>";
        echo "</form>";
        //form for php
        // button ot turn php to bull
        echo "<form method='post'>";
        echo "<input type='hidden' name='php' value='" . $row["PHP"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='php'>PHP:</label>";
    echo "<button type='submit' name='phpbull' class='btn btn-primary mt-3'>BULL</button>";
    echo "</div>";
    echo "</form>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='php' value='" . $row["PHP"] . "'>";
    echo "<div class='form-group'>";
    echo "<label for='php'>PHP:</label>";
    echo "<button type='submit' name='phpbear' class='btn btn-primary mt-3'>BEAR</button>";
    echo "</div>";
    echo "</form>";
        //form for startdatum
        echo "<form method='post'>";
        echo "<input type='hidden' name='startdatum' value='" . $row["Startdatum"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='startdatum'>Startdatum:</label>";
        echo "<input type='date' class='form-control' id='startdatum' name='startdatum' value='" . $row["Startdatum"] . "' required>";
        echo "<button type='submit' name='start' class='btn btn-primary mt-3'>Opslaan</button>";
        echo "</div>";
        echo "</form>";
        //form for einddatum
        echo "<form method='post'>";
        echo "<input type='hidden' name='einddatum' value='" . $row["Einddatum"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='einddatum'>Einddatum:</label>";
        echo "<input type='date' class='form-control' id='einddatum' name='einddatum' value='" . $row["Einddatum"] . "' required>";
        echo "<button type='submit' name='eind' class='btn btn-primary mt-3'>Opslaan</button>";
        echo "</div>";
        echo "</form>";
        //form for status
        echo "<form method='post'>";
        echo "<input type='hidden' name='status' value='" . $row["Status"] . "'>";
        echo "<div class='form-group'>";
        echo "<label for='status'>Status:</label>";
        echo "<input type='text' class='form-control' id='status' name='status' value='" . $row["Status"] . "' required>";
        echo "<button type='submit' name='status' class='btn btn-primary mt-3'>Opslaan</button>";
        echo "</div>";
        echo "</form>";
        
        echo 'html = ' . $row["HTML"];
        echo 'css = ' . $row["CSS"];
        echo 'js = ' . $row["JS"];
        echo 'php = ' . $row["PHP"];


    }
} else {
    echo "0 results";
}
$conn->close();
    ?>