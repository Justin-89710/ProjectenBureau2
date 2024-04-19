<?php
// error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Load Composer's autoloader
require 'vendor/autoload.php';

// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['submit'])) {
    // get data from form
    $name = $_GET['username'];
    $nummer = $_GET['studnmr'];
    $klas = $_GET['klas'];
    $gmail = $_GET['mail'];
    $reden = $_GET['what'];
    $project = $_GET['project'];

    // check if all fields are filled in
    if ($name == null || $nummer == null || $gmail == null || $reden == null || $klas == null || $project == null) {
        $error = "Please fill in all the fields.";
    } else {
        // Validate user's email address
        if (filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
            // send mail to Projecten Bureu
            $mailToProjectenBureu = new Email($name, $nummer, $klas, $gmail, $reden, $project);
            $mailToProjectenBureu->sendMail();

            // send confirmation mail to the user
            $mailToUser = new Email($name, $nummer, $klas, $gmail, $reden, $project);
            $mailToUser->sendConfirmationMail();

            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email address.";
        }
    }
}

class email
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

            $this->mail->Username = 'projectenbureu@gmail.com'; // SMTP username
            $this->mail->Password = 'qbcqnbydjahnbxmk'; // SMTP password
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
        $this->mail->addAddress('jljnootenboom@gmail.com', 'Projecten Bureu');
        $this->mail->addAddress('089710@glr.nl', 'Projecten Bureu');
        $this->mail->Subject = 'Aanvraag';

        // Set the Body as HTML
        $this->mail->isHTML(true);

        // HTML-formatted body
        $this->mail->Body = "
        <p><strong>$this->name</strong> wil meedoen aan een project!</p>
        <p>Het studentennummer van deze persoon is: <strong>$this->nummer</strong> en zit in klas <strong>$this->klas</strong>!</p>
        <p>Hij/Zij wilt meedoen omdat <strong>$this->reden</strong>!</p>
        <p>Deze persoon wilt meedoen aan het project: <strong>$this->project</strong>!</p>
        <p>U kunt hem/haar bereiken op: <a href='mailto:$this->gmail'>$this->gmail</a>.</p>
        <p>Vriendelijke groet,<br>Projecten Bureu.</p>
        <br>
        <p>Gemaakt door Justin Nootenboom!</p>
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
            <br>
            <p>Created by Justin Nootenboom</p>
        ";

        // Send the confirmation email
        $this->mail->send();
    }
}

?>