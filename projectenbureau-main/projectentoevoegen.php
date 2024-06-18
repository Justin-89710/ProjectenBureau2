<?php
//Start de sessie
session_start();

//Controleer of de gebruiker is ingelogd en een @glr-account heeft
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['email']) || strpos($_SESSION['email'], '@glr') === false) {
    header('Location: docenten_login.php');
    exit();
}

require_once "connection.php";
global $conn;

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Het ophalen van de gegevens uit het formulier
    $projectnaam = $_POST['projectnaam'];
    $beschrijving = $_POST['beschrijving'];
    $startdatum = $_POST['startdatum'];
    $einddatum = $_POST['einddatum'];
    $status = $_POST['status'];
    $afbeelding = $_FILES['afbeelding']['name'];
    $watwillen = $_POST['watwillen'];

    // Afbeelding uploaden naar media map
    move_uploaded_file($_FILES['afbeelding']['tmp_name'], 'media/' . $afbeelding);



    // Controleren of de HTML checkbox is aangevinkt
    $html = isset($_POST['html']) ? 'BULL' : 'BEAR';

    // Controleren of de CSS checkbox is aangevinkt
    $css = isset($_POST['css']) ? 'BULL' : 'BEAR';

    // Controleren of de JavaScript checkbox is aangevinkt
    $js = isset($_POST['js']) ? 'BULL' : 'BEAR';

    // Controleren of de PHP checkbox is aangevinkt
    $php = isset($_POST['php']) ? 'BULL' : 'BEAR';

    // Controleren of de overige checkbox is aangevinkt
    $over = isset($_POST['over']) ? 'BULL' : 'BEAR';

    //make qr code
    $qr = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://project.sd-lab.nl/project.php?id=".$projectnaam;
    //save qr code into media
    file_put_contents("media/".$projectnaam.".png", file_get_contents($qr));
    //save path to qr code
    $qr = "media/".$projectnaam.".png";

    // SQL-query om gegevens toe te voegen aan de database
    $sql = "INSERT INTO Projecten (ProjectNaam, ProjectBeschrijving, HTML, CSS, JS, PHP, overeg, Startdatum, Einddatum, Status, Afbeelding, watwil, QR) 
            VALUES ('$projectnaam', '$beschrijving', '$html', '$css', '$js', '$php', '$over', '$startdatum', '$einddatum', '$status', '$afbeelding', '$watwillen', '$qr')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success mt-3" role="alert">Project succesvol toegevoegd!</div>';
        header('Location: projecten.php');
    } else {
        echo '<div class="alert alert-danger mt-3" role="alert">Fout bij het toevoegen van het project: ' . $conn->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Toevoegen</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <a href="projecten.php" class="btn btn-primary">Terug naar projecten</a>
    <h2 class="mb-4">Project Toevoegen</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="projectnaam">Project Naam:</label>
            <input type="text" class="form-control" id="projectnaam" name="projectnaam" required>
        </div>
        <div class="form-group">
            <label for="html">HTML:</label>
            <input type="checkbox" class="form-control" id="html" name="html" >
        </div>
        <div class="form-group">
            <label for="css">CSS:</label>
            <input type="checkbox" class="form-control" id="css" name="css" >
        </div>
        <div class="form-group">
            <label for="php">PHP:</label>
            <input type="checkbox" class="form-control" id="php" name="php" >
        </div>
        <div class="form-group">
            <label for="js">JS:</label>
            <input type="checkbox" class="form-control" id="js" name="js" >
        </div>
        <div class="form-group">
            <label for="over">(geen van bovenstaande):</label>
            <input type="checkbox" class="form-control" id="over" name="over" >
        </div>
        <div class="form-group">
            <label for="beschrijving">over het project (max 674 tekens):</label>
            <textarea class="form-control" id="beschrijving" name="beschrijving" rows="3" maxlength="674" required></textarea>
        </div>
        <div class="form-group">
            <label for="beschrijving">Wat willen de project gevers? (max 674 tekens):</label>
            <textarea class="form-control" id="beschrijving" name="watwillen" rows="3" maxlength="674" required></textarea>
        </div>
        <div class="form-group">
            <label for="startdatum">Startdatum:</label>
            <input type="date" class="form-control" id="startdatum" name="startdatum" required>
        </div>
        <div class="form-group">
            <label for="einddatum">Einddatum:</label>
            <input type="date" class="form-control" id="einddatum" name="einddatum" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <div class="form-group">
            <label for="status">Afbeelding:</label>
            <input type="file" class="form-control" id="afbeelding" name="afbeelding" required>
        </div>
        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>

<!-- uitloggen -->
<div class="container mt-5">
    <a href="logout.php" class="btn btn-danger">Uitloggen</a>
</div>


</body>
</html>
