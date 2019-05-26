<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);


// Getting TextBox values
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$to = "bilgi@salihoz.av.tr";
$mail_body    = '<html>
             <body>
                 <h4>www.salihoz.av.tr site kullanicisindan mesajiniz var</h4>
                 <hr>
                 <p>Isim:<br>'.$name.'</p>
                 <p>E-mail:<br>'.$email.'</p>
                 <p>Telefon:<br>'.$phone.'</p>
                 <p>Konu:<br>'.$subject.'</p>
                 <p>Mesaj:<br>'.$message.'</p>
             </body>
         </html>';
$txt = " You have a message from: ".$name. "\n\n Phone: " .$phone. "\n\n Konu: " .$subject."\n\n Message: " .$message;



try {

    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.salihoz.av.tr';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'bilgi@salihoz.av.tr';                     // SMTP username
    $mail->Password   = 'salihoz2019';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to


    $mail->setFrom('bilgi@salihoz.av.tr', 'Av. Salih Öz');

    $mail->addAddress('bilgi@salihoz.av.tr', 'Av. Salih Öz');     // Add a recipient

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "[salihoz.av.tr sitesi kullanicisindan mesajiniz var
] - " .$name;
    $mail->Body    = $mail_body;
    $mail->AltBody = $txt;

    $mail->setLanguage('tr', 'vendor/phpmailer/phpmailer/language/phpmailer.lang-tr.php');

    $mail->send();
     header('Location:contact_success.html');
} catch (Exception $e) {
    echo "<script>alert('Uyarı! Mesajınız teknik bir hatadan dolayı gönderilemedi. Sorunuzu salihoz@istanbulbarosu.org.tr adresine e-mail olarak iletebilirsiniz.');</script>" ;
    header('Location:contact.html');
  }
