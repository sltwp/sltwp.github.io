<?php

if ($_POST) {
    $visitor_name = "";
    $visitor_email = "";
    $visitor_phone = "";
    $visitor_message = "";
    $email_body = "<div>";
    $email_title = "Nová zpráva z kontaktního formuláře 3S Security";
    $recipient = "simonsotak97@gmail.com";

    if (isset($_POST['visitor_name'])) {
        $visitor_name = filter_var($_POST['visitor_name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div> 
<label><b>Jméno:</b></label>&nbsp;<span>" . $visitor_name . "</span> 
</div>";
    }
    if (isset($_POST['visitor_email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['visitor_email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div> 
<label><b>E-mail:</b></label>&nbsp;<span>" . $visitor_email . "</span> 
</div>";
    }

    if (isset($_POST['visitor_phone'])) {
        $visitor_phone = filter_var($_POST['visitor_phone'], FILTER_SANITIZE_STRING);
        $email_body .= "<div> 
<label><b>Tel. číslo:</b></label>&nbsp;<span>" . $visitor_phone . "</span> 
</div>";
    }

    if (isset($_POST['visitor_message'])) {
        $visitor_message = htmlspecialchars($_POST['visitor_message']);
        $email_body .= "<div> 
<label><b>Zpráva:</b></label> 
<div>" . $visitor_message . "</div> 
</div>";
    }

    $email_body .= "</div>";
    $headers = 'MIME-Version: 1.0' . "\r\n"
        . 'Content-type: text/html; charset=utf-8' . "\r\n"
        . 'From: ' . $visitor_email . "\r\n";

    if (mail($recipient, $email_title, $email_body, $headers)) {
        echo "<p>Děkujeme, $visitor_name, Vaše zpráva byla úspěšné odesláná.Test.</p>";
    } else {
        echo '<p>Omlouváme se, něco se pokazilo.</p>';
    }

} else {
    echo '<p>Omlouváme se, něco se pokazilo.</p>';
}
?>