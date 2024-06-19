<?php
//show server errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Load Composer's autoloader
require 'vendor/vendor/autoload.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//connect to the database
require_once "connection.php";
global $conn;

if (isset($_POST['verify'])) {
    $enteredCode = $_POST['code'];

    if ($enteredCode == $_SESSION['verificationCode']) {
        // Retrieve form data from session
        $name = $_SESSION['formData']['username'];
        $nummer = $_SESSION['formData']['studnmr'];
        $klas = $_SESSION['formData']['klas'];
        $gmail = $_SESSION['formData']['mail'];
        $reden = $_SESSION['formData']['what'];
        $project = $_SESSION['formData']['project'];

        // send mail to Projecten Bureu
        $mailToProjectenBureu = new Email($name, $nummer, $klas, $gmail, $reden, $project);
        $mailToProjectenBureu->sendMail();

        // send confirmation mail to the user
        $mailToUser = new Email($name, $nummer, $klas, $gmail, $reden, $project);
        $mailToUser->sendConfirmationMail();

        // Clear session data
        unset($_SESSION['verificationCode']);
        unset($_SESSION['formData']);

        // put all info into the database
        $sql = "INSERT INTO Aanmeldingen (Naam, Studentennummer, Klas, Email, Reden, Project) VALUES ('$name', '$nummer', '$klas', '$gmail', '$reden', '$project')";
        $conn->query($sql);

        header("Location: index.php");
        exit();
    } else {
        $error = "Incorrect verification code.";
    }
}

class Email
{
    private $name;
    private $nummer;
    private $klas;
    private $gmail;
    private $reden;
    private $project;

    public function __construct($name, $nummer, $klas, $gmail, $reden, $project)
    {
        $this->name = $name;
        $this->nummer = $nummer;
        $this->klas = $klas;
        $this->gmail = $gmail;
        $this->reden = $reden;
        $this->project = $project;
        $this->mail = new PHPMailer(true);
    }

    public function setupMail()
    {
        try {
            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.gmail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = 587;

            $this->mail->Username = 'projectenbureu@gmail.com';
            $this->mail->Password = 'qbcqnbydjahnbxmk';
            $this->mail->setFrom('projectenbureu@gmail.com', 'Projecten Bureu');

            $this->mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER; // Enable verbose debug output
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
        }
    }

    public function prepmail()
    {
        $this->setupMail();

        $this->mail->addAddress('goldewijk@glr.nl', 'Projecten Bureu');
        $this->mail->addAddress('wklomp@glr.nl', 'Projecten Bureu');
        $this->mail->Subject = 'Nieuwe aanvraag';

        // Set the Body as HTML
        $this->mail->isHTML(true);

        // HTML-formatted body
        $this->mail->Body = "
            <p>Er is een nieuwe aanvraag binnengekomen voor het project: $this->project</p>
    ";
    }

    public function sendMail()
    {
        $this->prepmail();
        $this->mail->send();
    }

    public function sendConfirmationMail()
    {
        // Set up the confirmation email
        $this->setupMail();

        // Set the recipient to the user's email address
        $this->mail->addAddress($this->gmail, $this->name);

        // Set the subject for the confirmation email
        $this->mail->Subject = 'Confirmation - Aanvraag Projecten Bureu';

        // Set the Body as HTML for the confirmation email
        $this->mail->isHTML(true);

        // HTML-formatted body for the confirmation email
        $this->mail->Body = "
            <p>Beste, $this->name,</p>
            <p>Wat leuk dat je wilt meedoen met ProjectenBureu!</p>
            <p>Met deze mail kunt u uw info nog terug vinden die u heeft ingevuld.</p>
            <p>Wat je hebt ingevuld:</p>
            <ul>
                <li><strong>Naam:</strong> $this->name</li>
                <li><strong>Studentennummer:</strong> $this->nummer</li>
                <li><strong>Klas:</strong> $this->klas</li>
                <li><strong>Email:</strong> $this->gmail</li>
                <li><strong>Reden:</strong> $this->reden</li>
            </ul>
            <p>We vinden het leuk dat je meedoet en u krijgt zo snel mogelijk een reactie!</p>
            <p>Met vriendelijke groet,<br>Projecten Bureu</p>
        ";

        // Send the confirmation email
        $this->mail->send();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code</title>
</head>
<body>
<form method="post" action="">
    <label for="code">Enter Verification Code:</label>
    <input type="text" id="code" name="code" required>
    <button type="submit" name="verify">Verify</button>
</form>
<?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>