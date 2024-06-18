<?php
// Show server errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include connection.php
require_once "../connection.php";
global $conn;

// Get all projects from the database
$sql = "SELECT * FROM Projecten";
$result = $conn->query($sql);

$projects = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

// Pass projects array to JavaScript
echo "<script>var projects = " . json_encode($projects) . ";</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecten Bureau</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="bg-vormen">
        <div class="blue-bg">
            <svg width="934" height="1438" viewBox="0 0 934 1438" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M934 0L203.116 773.766C203.116 773.766 156.732 818.624 196.724 853.496C236.716 888.369 361.447 762.164 361.447 762.164L668.518 468.263C668.518 468.263 753.277 401.301 807.651 429.8C862.026 458.299 873.233 493.172 754.875 631C636.517 768.806 0 1438 0 1438H934V0Z" fill="url(#paint0_linear_90_54)"/>
                <defs>
                    <linearGradient id="paint0_linear_90_54" x1="0" y1="718.989" x2="934" y2="718.989" gradientUnits="userSpaceOnUse">
                        <stop offset="0.55" stop-color="#5C7BBA"/>
                        <stop offset="1" stop-color="#506EAC"/>
                    </linearGradient>
                </defs>
            </svg>
            <svg
                    class="pijl"
                    width="687"
                    height="863"
                    viewBox="0 0 687 863"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <path
                        d="M170 0.999755C261.333 0.666422 338.157 31.4593 369 42.9986C438.5 68.9999 428 118.998 375 147.498C322 175.998 144.5 176.499 58.5003 273.998C19.1356 318.626 -52.4997 508.498 71.5003 671.998C195.5 835.498 579.199 834.498 586 834.498C596 834.498 653 832.5 684.5 827M684.5 827L647.5 862M684.5 827L647.5 798"
                        stroke="#0B4878"
                        stroke-width="2"
                />
            </svg>
            <div class="white-bg">
                <svg
                        width="152"
                        height="231"
                        viewBox="0 0 152 231"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M151.992 0C151.992 0 -46.1585 144.11 10.034 210.882C66.2266 277.655 151.992 156.796 151.992 156.796"
                            fill="white"
                    />
                </svg>
            </div>
        </div>
    <header>
        <div class="head-logo-text">
            <img src="../media/GLRlogo_witkader 2.png" alt="Logo" />
            <h1>Projecten Bureau</h1>
        </div>
        <div class="vormen">
            <img src="../media/vormen.png" alt="Vormen" />
        </div>
    </header>

    <div class="hero">
        <img class="rotating" src="../media/Cirkel.png" alt="Cirkel" />
        <div class="hero-title"><p id="Title"></p></div>
        <div class="hero-time">
<!--            <p id="timer"></p>-->
        </div>
        <div class="hero-vak"><p>BEROEPS</p></div>
    </div>

    <div class="verwachtingen">
        <div class="verwachtingen-title"><p>Beschrijving van project!:</p></div>
        <div class="verwachtingen-text-box">
            <p id="beschrijving"></p>
        </div>
        <img class="verwachtingen-img" id="afbeelding" src="" alt="Project Afbeelding" />
    </div>

    <div class="ervaringen">
        <div class="ervaringen-title"><p>Ervaringen</p></div>
        <div class="ervaringen-list">
            <div class="ervaringen-html">
                <p>startdatum:</p>
                <p id="startdatum"></p>
            </div>
            <div class="ervaringen-css">
                <p>einddatum:</p>
                <p id="einddatum"></p>
            </div>
            <div class="ervaringen-js">
                <p>status:</p>
                <p id="status"></p>
            </div>
            <div class="ervaringen-php">
                <p>Wat willen de project gevers?</p>
                <p id="watwil"></p>
            </div>
        </div>
    </div>

    <div class="qr">
        <div class="qr-title"><p>Meld je aan!</p></div>
        <div class="qr-block">
            <img src="" alt="QR Code" id="qr" />
        </div>
    </div>

    <script>
        // function updateTimer() {
        //     const endDate = new Date('2024-04-30T23:59:59');
        //     const currentDate = new Date();
        //
        //     const timeDifference = endDate - currentDate;
        //     const days = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
        //
        //     const timerElement = document.getElementById('timer');
        //
        //     if (days >= 1) {
        //         timerElement.textContent = `Je hebt nog: ${days} Dag${days > 1 ? 'en' : ''}`;
        //     } else {
        //         const hours = Math.floor(timeDifference / (1000 * 60 * 60));
        //         const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        //         const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
        //
        //         timerElement.textContent = `Je hebt nog: ${hours}:${minutes}:${seconds}`;
        //     }
        // }
        //
        // setInterval(updateTimer, 1000);
        // updateTimer();

        let currentProjectIndex = 0;

        function showProject(index) {
            const project = projects[index];
            document.getElementById('Title').textContent = project.ProjectNaam;
            document.getElementById('beschrijving').textContent = project.ProjectBeschrijving;
            document.getElementById('startdatum').textContent = `Startdatum: ${project.Startdatum}`;
            document.getElementById('einddatum').textContent = `Einddatum: ${project.Einddatum}`;
            document.getElementById('status').textContent = `Status: ${project.Status}`;
            document.getElementById('afbeelding').src = `../media/${project.Afbeelding}`;
            document.getElementById('watwil').textContent = project.watwil;
            document.getElementById('qr').src = `../${project.QR}`;
        }

        function rotateProjects() {
            showProject(currentProjectIndex);
            currentProjectIndex = (currentProjectIndex + 1) % projects.length;
        }

        setInterval(rotateProjects, 1000); // Change project every 60 seconds
        rotateProjects(); // Initial call to display the first project

    </script>
</div>
</body>
</html>
