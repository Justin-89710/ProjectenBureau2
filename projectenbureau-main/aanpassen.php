<?php
// server errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// get info from database
require_once "connection.php";
global $conn;

// get name from url
$projectNaam = $_GET["id"];

// handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // update project name
    if (isset($_POST["projectnaam"])) {
        $projectnaam = $_POST["projectnaam"];
        $stmt = $conn->prepare("UPDATE Projecten SET ProjectNaam = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $projectnaam, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update project description
    if (isset($_POST["projectbeschrijving"])) {
        $beschrijving = $_POST["projectbeschrijving"];
        $stmt = $conn->prepare("UPDATE Projecten SET ProjectBeschrijving = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $beschrijving, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update watwil
    if (isset($_POST["watwil"])) {
        $watwil = $_POST["watwil"];
        $stmt = $conn->prepare("UPDATE Projecten SET watwil = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $watwil, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update HTML
    if (isset($_POST["html"])) {
        $html = ($_POST["html"] == 'BULL') ? 'BULL' : 'BEAR';
        $stmt = $conn->prepare("UPDATE Projecten SET HTML = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $html, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update CSS
    if (isset($_POST["css"])) {
        $css = ($_POST["css"] == 'BULL') ? 'BULL' : 'BEAR';
        $stmt = $conn->prepare("UPDATE Projecten SET CSS = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $css, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update JS
    if (isset($_POST["js"])) {
        $js = ($_POST["js"] == 'BULL') ? 'BULL' : 'BEAR';
        $stmt = $conn->prepare("UPDATE Projecten SET JS = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $js, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update PHP
    if (isset($_POST["php"])) {
        $php = ($_POST["php"] == 'BULL') ? 'BULL' : 'BEAR';
        $stmt = $conn->prepare("UPDATE Projecten SET PHP = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $php, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update startdatum
    if (isset($_POST["startdatum"])) {
        $startdatum = $_POST["startdatum"];
        $stmt = $conn->prepare("UPDATE Projecten SET Startdatum = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $startdatum, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update einddatum
    if (isset($_POST["einddatum"])) {
        $einddatum = $_POST["einddatum"];
        $stmt = $conn->prepare("UPDATE Projecten SET Einddatum = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $einddatum, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update status
    if (isset($_POST["status"])) {
        $status = $_POST["status"];
        $stmt = $conn->prepare("UPDATE Projecten SET Status = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $status, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    // update overige (BULL or BEAR)
    if (isset($_POST["overige"])) {
        $overige = ($_POST["overige"] == 'BULL') ? 'BULL' : 'BEAR';
        $stmt = $conn->prepare("UPDATE Projecten SET overeg = ? WHERE ProjectNaam = ?");
        $stmt->bind_param("ss", $overige, $projectNaam);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// fetch project details from database
$sql = "SELECT * FROM Projecten WHERE ProjectNaam = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $projectNaam);
$stmt->execute();
$result = $stmt->get_result();

// display forms for editing project details
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<form method='post'>";

        // form for project name
        echo "<div class='form-group'>";
        echo "<label for='projectnaam'>Project Naam:</label>";
        echo "<input type='text' class='form-control' id='projectnaam' name='projectnaam' value='" . $row["ProjectNaam"] . "' required>";
        echo "</div>";

        // form for project description
        echo "<div class='form-group'>";
        echo "<label for='projectbeschrijving'>Project Beschrijving:</label>";
        echo "<textarea class='form-control' id='projectbeschrijving' name='projectbeschrijving' rows='3' required>" . $row["ProjectBeschrijving"] . "</textarea>";
        echo "</div>";

        // form for watwil
        echo "<div class='form-group'>";
        echo "<label for='watwil'>Wat willen de projectgevers:</label>";
        echo "<textarea class='form-control' id='watwil' name='watwil' rows='3' required>" . $row["watwil"] . "</textarea>";
        echo "</div>";

        // form for HTML
        echo "<div class='form-group'>";
        echo "<label for='html'>HTML:</label>";
        echo "<select class='form-control' id='html' name='html'>";
        echo "<option value='BULL' " . ($row["HTML"] == 'BULL' ? 'selected' : '') . ">BULL</option>";
        echo "<option value='BEAR' " . ($row["HTML"] == 'BEAR' ? 'selected' : '') . ">BEAR</option>";
        echo "</select>";
        echo "</div>";

        // form for CSS
        echo "<div class='form-group'>";
        echo "<label for='css'>CSS:</label>";
        echo "<select class='form-control' id='css' name='css'>";
        echo "<option value='BULL' " . ($row["CSS"] == 'BULL' ? 'selected' : '') . ">BULL</option>";
        echo "<option value='BEAR' " . ($row["CSS"] == 'BEAR' ? 'selected' : '') . ">BEAR</option>";
        echo "</select>";
        echo "</div>";

        // form for JS
        echo "<div class='form-group'>";
        echo "<label for='js'>JS:</label>";
        echo "<select class='form-control' id='js' name='js'>";
        echo "<option value='BULL' " . ($row["JS"] == 'BULL' ? 'selected' : '') . ">BULL</option>";
        echo "<option value='BEAR' " . ($row["JS"] == 'BEAR' ? 'selected' : '') . ">BEAR</option>";
        echo "</select>";
        echo "</div>";

        // form for PHP
        echo "<div class='form-group'>";
        echo "<label for='php'>PHP:</label>";
        echo "<select class='form-control' id='php' name='php'>";
        echo "<option value='BULL' " . ($row["PHP"] == 'BULL' ? 'selected' : '') . ">BULL</option>";
        echo "<option value='BEAR' " . ($row["PHP"] == 'BEAR' ? 'selected' : '') . ">BEAR</option>";
        echo "</select>";
        echo "</div>";

        // form for overige
        echo "<div class='form-group'>";
        echo "<label for='overige'>Overige:</label>";
        echo "<select class='form-control' id='overige' name='overige'>";
        echo "<option value='BULL' " . ($row["overige"] == 'BULL' ? 'selected' : '') . ">BULL</option>";
        echo "<option value='BEAR' " . ($row["overige"] == 'BEAR' ? 'selected' : '') . ">BEAR</option>";
        echo "</select>";
        echo "</div>";

        // form for startdatum
        echo "<div class='form-group'>";
        echo "<label for='startdatum'>Startdatum:</label>";
        echo "<input type='date' class='form-control' id='startdatum' name='startdatum' value='" . $row["Startdatum"] . "' required>";
        echo "</div>";

        // form for einddatum
        echo "<div class='form-group'>";
        echo "<label for='einddatum'>Einddatum:</label>";
        echo "<input type='date' class='form-control' id='einddatum' name='einddatum' value='" . $row["Einddatum"] . "' required>";
        echo "</div>";

        // form for status
        echo "<div class='form-group'>";
        echo "<label for='status'>Status:</label>";
        echo "<select class='form-control' id='status' name='status'>";
        echo "<option value='In behandeling' " . ($row["Status"] == 'In behandeling' ? 'selected' : '') . ">In behandeling</option>";
        echo "<option value='Afgerond' " . ($row["Status"] == 'Afgerond' ? 'selected' : '') . ">Afgerond</option>";
        echo "<option value='Geannuleerd' " . ($row["Status"] == 'Geannuleerd' ? 'selected' : '') . ">Geannuleerd</option>";
        echo "</select>";
        echo "</div>";

        // submit button
        echo "<button type='submit' class='btn btn-primary'>Submit</button>";

        echo "</form>";
    }
} else {
    echo "No records found";
}
$stmt->close();
$conn->close();
?>
