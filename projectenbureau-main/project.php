<?php
//include the database connection
require_once "connection.php";
global $conn;

//get the id form the url
$id = $_GET['id'];

//get the project from the database
$sql = "SELECT * FROM Projecten WHERE ProjectNaam = '$id'";
$result = $conn->query($sql);

//save everything in variables
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projectnaam = $row['ProjectNaam'];
        $beschrijving = $row['ProjectBeschrijving'];
        $html = $row['HTML'];
        $css = $row['CSS'];
        $js = $row['JS'];
        $php = $row['PHP'];
        $startdatum = $row['Startdatum'];
        $einddatum = $row['Einddatum'];
        $status = $row['Status'];
        $afbeelding = $row['Afbeelding'];
        $watwil = $row['watwil'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $projectnaam; ?></title>
    <link rel="stylesheet" href="css/project.css" />
</head>
<body>
<head>
    <a href="index.php"><img  class="logo" src="./media/GLRlogo_witkader 2.png" alt="" />
    </a>
    <h1 class="title"><?php echo $projectnaam; ?></h1>
    <img class="head-bg-img" src="media/background.png" alt="" />
    <div class="skills">
        <p class="skills-title">Skills</p>
        <?php
        if ($html == "BULL") {
            echo "HTML" . "<br>";
        }
        if ($css == "BULL") {
            echo "CSS" . "<br>";
        }
        if ($js == "BULL") {
            echo "JS" . "<br>";
        }
        if ($php == "BULL") {
            echo "PHP" . "<br>";
        }
        ?>
    </div>
</head>
<div class="hero">
    <div class="hero-title">
        <p>OVER</p><p style="color: #0063af;"><?php echo $projectnaam; ?></p>
    </div>
    <div class="hero-text"><p><?php echo $beschrijving; ?></p>
    </div>
</div>
<div class="section-1">
    <div class="section-1-left">
        <div class="section-1-left-bg"><img src="media/<?php echo $afbeelding; ?>" alt="">
        </div>
    </div>
    <div class="section-1-right">
        <div class="section-1-title"><p>WAT WIL</p><p style="color: #0063af;"><?php echo $projectnaam; ?></p></div>
        <p class="section-1-text"><?php echo $watwil; ?>
        </p>
    </div>
</div>

<center><hr class="blue-line"></center>
<center>
    <div class="sign-up-form">
        <p class="sign-up-title">Ben jij geïnteresseerd en klaar voor een leuke, nieuwe uitdaging?</p>
        <p class="sign-up-title">Meld je aan!</p>
        <form action="aanmeld.php?">

            <div>
                <label class="naam" for="username"></label>
                <input placeholder="Naam" type="text" name="username" required>
            </div>
            <div>
                <label class="email" for="studnmr"></label>
                <input placeholder="Student nummer" type="text" name="studnmr" required>
            </div>
            <div>
                <label class="email" for="mail"></label>
                <input placeholder="Studenten email" required name="mail"></input>
            </div>
            <div>
                <label class="email" for="klas"></label>
                <input placeholder="Klas" required name="klas"></input>
            </div>
            <div>
                <label class="email" for="what"></label>
                <textarea placeholder="Waarom wil jij meedoen?" required rows="5" name="what"></textarea>
            </div>
            <!--hidden input field with the project name-->
            <input type="hidden" name="project" value="<?php echo $projectnaam; ?>">
            <button type="submit" name="submit">Aanmelden</button>
        </form>
    </div>
</center>


<footer>
    <div class="footer-left">

    </div>
    <div class="footer-right">

    </div>
</footer>
</body>
</html>

