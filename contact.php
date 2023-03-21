<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    # FIX: Replace this email with recipient email
    $mail_to = "simonsotak97@gmail.com";
    
    # Sender Data
    $subject = "Nová zpráva z kontaktního formuláře 3ssecurity.cz";
    $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);
    
    if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($phone) OR empty($subject) OR empty($message)) {
        # Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }
    
    # Mail Content
    $content = "Jméno: $name\n";
    $content .= "Email: $email\n\n";
    $content .= "Telefon: $phone \n\n";
    $content .= "Zpráva:\n$message\n";

    # email headers.
    $headers = "From: $name <$email>";
    $headers .= 'MIME-Version: 1.0' ."\r\n";
    $headers .= 'Content-Type: text/HTML; charset=utf-8' . "\r\n";
    $headers .= 'Content-Transfer-Encoding: 8bit'. "\n\r\n";
    # $headers .= $text . "\r\n";


    # Send the email.
    $success = mail($mail_to, $subject, $content, $headers);
    if ($success) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Your message has been sent.";
    } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong, we couldn't send your message.";
    }

} else {
    # Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}






/*

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
}*/
?>