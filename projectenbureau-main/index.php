<?php
//show server errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

//connect to the database
require_once "connection.php";
global $conn;

//get all projects from the database
$sql = "SELECT * FROM Projecten";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Projecten Bureau</title>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="shortcut icon" href="./media/glr-logo.png" type="image/x-icon" />
</head>

<body>
<nav>
    <div class="bg"></div>
    <img class="logo" src="./media/GLRlogo_witkader 2.png" alt="" />
    <div class="titel">PROJECTEN <br> BUREAU</div>
</nav>

<div class="projecten">
    <h2>Lopende Projecten</h2>
    <?php
    $i = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $out = "<p class='currproj";
            if($i%2 == 0){
                $out .= '-r';
            }
            $out .= "'>" . $row["ProjectNaam"] . "</p>";
            echo $out;
        }
    } else {
        echo "0 results";
    }
    ?>
</div>

<div class="about">
    <h2>&nbsp;ProjectenBureau</h2>
    <p>
        Ben jij klaar om je kennis in de praktijk te brengen en je CV een boost te geven? Het projectenbureau heeft dé kans voor jou! Met ons 'Leren door Doen'-programma krijg je de kans om écht aan de slag te gaan. Van het allereerste contact met de klant tot het schitteren met jouw design tijdens de finale presentatie.
        Zodra er een perfecte opdracht binnenrolt, vormen we een projectgroep met studenten zoals jij, die staan te popelen om hun talenten te laten zien. We duiken samen in de briefing, brainstormen over design en zetten een strakke planning neer. Jouw ideeën en creaties worden tussendoor gepresenteerd, zodat je waardevolle feedback kunt verzamelen en verwerken. Aan het einde van de rit lever jij een eindproduct af waar je trots op kunt zijn.
        Doe je mee? Meld je aan en transformeer die theorie in ervaring!</p>
</div>


<div class="lopendeprojecten"> <p> Lopende &nbsp; </p></div>




<div class="wrapper">
<!--    <div class="project">-->
<!--        <div class="projecttitel">KNOEFY</div>-->
<!--        <div class="projectkennis">-->
<!--            <div class="block1"><img src="./media/html-logo.png" alt="" /></div>-->
<!--            <div class="block2"><img src="./media/css-logo.png" alt="" /></div>-->
<!--            <div class="block3"><img src="./media/js-logo.png" alt="" /></div>-->
<!--            <div style="display: none;" class="block4"><img src="./media/php-logo.png" alt="" /></div>-->
<!--        </div>-->
<!--        <div class="projectinfo">-->
<!--            Wat wil Knoefy <br>-->
<!--            We zouden graag een app aan ons aanbod toe willen voegen <br> waarin de kinderen spelletjes kunnen spelen en filmpjes kunnen kijken. <br> We hopen op een mooie samenwerking met studenten die dit kunnen ontwikkelen.-->
<!--        </div>-->
<!--        <a href="./project1.html" class="projectbtn">Inschrijving gesloten</a>-->
<!--        <div class="projectimg"><img src="./media/logo-knoefy.png" alt="" /></div>-->
<!--    </div>-->

    <?php
    //make a loop to show all projects
    $result->data_seek(0);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Convert "BULL" to "Ja" and anything else to "Nee"
            $html = ($row["HTML"] == "BULL") ? "Ja" : "Nee";
            $css = ($row["CSS"] == "BULL") ? "Ja" : "Nee";
            $js = ($row["JS"] == "BULL") ? "Ja" : "Nee";
            $php = ($row["PHP"] == "BULL") ? "Ja" : "Nee";
            echo "<div class='project'>";
            echo "<div class='projecttitel'>" . $row["ProjectNaam"] . "</div>";
            echo "<div class='projectkennis'>";
            if ($html == "Ja") {
                echo "<div class='block1'><img src='./media/html-logo.png' alt='' /></div>";
            }
            if ($css == "Ja") {
                echo "<div class='block2'><img src='./media/css-logo.png' alt='' /></div>";
            }
            if ($js == "Ja") {
                echo "<div class='block3'><img src='./media/js-logo.png' alt='' /></div>";
            }
            if ($php == "Ja") {
                echo "<div class='block4'><img src='./media/php-logo.png' alt='' /></div>";
            }
            echo "</div>";
            echo "<div class='projectinfo'>" . $row["ProjectBeschrijving"] . "</div>";
            echo "<a href='./project.php?id=" . $row["ProjectNaam"] . "' class='projectbtn'>Schrijf Je Nu In!</a>";
            echo "<div class='projectimg'><img src='./media/" . $row["Afbeelding"] . "' alt='' /></div>";
            echo "</div>";
        }
    } else {
        echo "0 results";
    }
    ?>
<!--    <div class="project">-->
<!--        <div class="projecttitel">Historisch Hoek van Holland</div>-->
<!--        <div class="projectkennis">-->
<!--            <div class="block1"><img src="./media/html-logo.png" alt="" /></div>-->
<!--            <div class="block2"><img src="./media/css-logo.png" alt="" /></div>-->
<!--            <div class="block3"><img src="./media/js-logo.png" alt="" /></div>-->
<!--            <div class="block4"><img src="./media/php-logo.png" alt="" /></div>-->
<!--        </div>-->
<!--        <div class="projectinfo">-->
<!--            Bezoekers kunnen zoeken op jaartal, onderwerp of gebeurtenis. De auteurs zijn vrijwilligers van het Historisch Genootschap die veel onderzoek doen. De lezers zijn onze donateurs, volgers, de Hoekenezen en iedereeen die zoekt op wereldgebeurtenissen waar Hoek van Holland een rol in had.-->
<!--        </div>-->
<!--        <a href="./project2.html" class="projectbtn">Schrijf Je Nu In!</a>-->
<!--        <div class="projectimg"><img src="./media/stichtinghistorischhvh.jpeg" alt="" /></div>-->
<!--    </div>-->
<!--    <div class="project">-->
<!--        <div class="projecttitel">Web Ikonen</div>-->
<!--        <div class="projectkennis">-->
<!--            <div class="block1"><img src="./media/html-logo.png" alt="" /></div>-->
<!--            <div class="block2"><img src="./media/css-logo.png" alt="" /></div>-->
<!--            <div class="block3"><img src="./media/js-logo.png" alt="" /></div>-->
<!--            <div class="block4"><img src="./media/php-logo.png" alt="" /></div>-->
<!--        </div>-->
<!--        <div class="projectinfo">-->
<!--            Wil jij voor de scholenmarkt Ahoi een tablet interface maken om je-->
<!--            school te promoten? <br />-->
<!--            Dit project vereist teamverband tussen de mede geintereseerden in dit-->
<!--            project. het idee is om een verkorte website te maken van de glr-->
<!--            website zodat scholieren...-->
<!--        </div>-->
<!--        <a href="./project3.html" class="projectbtn">Schrijf Je Nu In!</a>-->
<!--        <div class="projectimg"><img src="./media/beurs.jpg" alt="" /></div>-->
<!--    </div>-->
</div>
</div>
</body>
</html>

