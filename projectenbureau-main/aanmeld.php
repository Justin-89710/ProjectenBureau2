<?php
session_start();

// error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Load Composer's autoloader
require 'vendor/vendor/autoload.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['submit'])) {
    // get data from form
    $name = $_GET['username'];
    $nummer = $_GET['studnmr'];
    $klas = $_GET['klas'];
    $gmail = $_GET['mail'];
    echo $gmail;
    $reden = $_GET['what'];
    $project = $_GET['project'];

    // check if all fields are filled in
    if ($name == null || $nummer == null || $gmail == null || $reden == null || $klas == null || $project == null) {
        $error = "Please fill in all the fields.";
    } elseif (!preg_match('/@glr\.nl$/', $gmail)) {
        $error = "Invalid email address.";
    } else {
        if (filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
                // Generate a random 4-digit verification code
                $verificationCode = rand(1000, 9999);
                $_SESSION['verificationCode'] = $verificationCode;
                $_SESSION['formData'] = $_GET; // Store form data in session

                // Send verification code to user's email
                $verificationEmail = new PHPMailer(true);

                try {
                    $verificationEmail->isSMTP();
                    $verificationEmail->Host = 'smtp.gmail.com';
                    $verificationEmail->SMTPAuth = true;
                    $verificationEmail->SMTPSecure = 'tls';
                    $verificationEmail->Port = 587;

                    $verificationEmail->Username = 'projectenbureu@gmail.com';
                    $verificationEmail->Password = 'qbcqnbydjahnbxmk';
                    $verificationEmail->setFrom('projectenbureu@gmail.com', 'Projecten Bureu');

                    $verificationEmail->addAddress($gmail, $name);
                    $verificationEmail->Subject = 'Verification Code';
                    $verificationEmail->isHTML(true);
                    $verificationEmail->Body = "<p>Your verification code is: <strong>$verificationCode</strong></p>";

                    $verificationEmail->send();
                    header("Location: verify.php");
                    exit();
                } catch (Exception $e) {
                    echo "Verification code could not be sent. Mailer Error: {$verificationEmail->ErrorInfo}";
                }
            } else {
            $error = "Invalid email address.";
        }
    }
}

if (isset($error)) {
    header("Location: project.php?id=$project&error=$error");
}
?>