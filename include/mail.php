<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$is_ok = false;
$consol_msg = 'aucun traitement';

require '../libs/phpmailer/src/PHPMailer.php';
require '../libs/phpmailer/src/Exception.php';
require '../libs/phpmailer/src/SMTP.php';

function send_mail($messageHTML, $envoyeur, $receveur, $sujet) {
    $message = '<html><head></head><body>'.$messageHTML.'</body></html>';

    try {
        $courriel = new PHPMailer(TRUE);
        $courriel->setLanguage('fr', __DIR__.'/../phpmailer/language/phpmailer.lang-fr.php');
        /* Set the mail sender. */
        $courriel->setFrom($envoyeur);
        /* Add a recipient. */
        $courriel->addAddress($receveur);
        /* Set the subject. */
        $courriel->Body = $message;
        $courriel->Subject = $sujet;
        /* Set the mail message body. */
        $courriel->IsHTML(true);
        /* Finally send the mail. */
        $courriel->send();

        return true;

    } catch (Exception $error) {
        return false;
    }
}

if (isset($_POST) && !empty($_POST['courriel'])
    && !empty($_POST['objet'])
    && !empty($_POST['message'])
    && $_POST['bot_nempty'] == '9hHZ@Jz623'
    && empty($_POST['bot_empty'])) {

    $is_send = send_mail($_POST['message'], $_POST['courriel'], $adresse_reception, $_POST['objet']);

    if ($is_send) {
        $consol_msg = '<p>Votre message a bien été envoyé.</p>';
        $is_ok = true;
    } else {
        $consol_msg = '<p>Il y eu une erreur interne.</p>';
    }

} else {
    $consol_msg = '<p>Il y a eu une erreur lors de l\'envoi.</p>';
}

echo json_encode(array('isOk' => $is_ok, 'consolMsg' => $consol_msg));