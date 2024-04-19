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

    // SQL-query om gegevens toe te voegen aan de database
    $sql = "INSERT INTO Projecten (ProjectNaam, ProjectBeschrijving, HTML, CSS, JS, PHP, Startdatum, Einddatum, Status, Afbeelding, watwil) 
            VALUES ('$projectnaam', '$beschrijving', '$html', '$css', '$js', '$php', '$startdatum', '$einddatum', '$status', '$afbeelding', '$watwillen')";

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
            <label for="beschrijving">over het project (max 100 worden):</label>
            <textarea class="form-control" id="beschrijving" name="beschrijving" rows="3" maxlength="100" required></textarea>
        </div>
        <div class="form-group">
            <label for="beschrijving">Wat willen de project gevers? (max 100 worden):</label>
            <textarea class="form-control" id="beschrijving" name="beschrijving" rows="3" maxlength="100" required></textarea>
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
