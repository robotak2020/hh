<?php

namespace App\Controllers\news;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
require 'vendor/PHPMailer/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';

use System\Controller;

class ContactController extends Controller
{
    /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle($this->settings->get('site_name') . ' Contact');

        // i will use getOutput() method just to display errors
        // as i'm using php 7 which is throwing all errors as exceptions
        // which won't be thrown through the __toString() method

        $view = $this->view->render('news/contact');

        return $this->newsLayout->render($view);
    }


    /**
     * Display Home Page
     *
     */
    public function submit()
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        $email = strip_tags(htmlspecialchars(filter_var($this->request->post('email'),FILTER_VALIDATE_EMAIL)));
        $subject = strip_tags(htmlspecialchars($this->request->post('subject')));
        $name = strip_tags(htmlspecialchars($this->request->post('name')));
        $message = strip_tags(htmlspecialchars($this->request->post('message')));
        if (empty($email) || empty($subject) || empty($name) || empty($message)) {
            http_response_code(500);
            return null;
        }
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.mailgun.org';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'postmaster@sandbox54722af0ce5b4a028a254e52963e011a.mailgun.org';                 // SMTP username
            $mail->Password = '6cd30ddc18feb8aa96d4726183325c95-9b1bf5d3-17e7b5e5';                           // SMTP password
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('postmaster@sandbox54722af0ce5b4a028a254e52963e011a.mailgun.org');
            $mail->addAddress($email);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $text = $name.'<br>';
            $text .= $message;

            $mail->Body    = $text;

            $mail->send();
            echo 'Message has been sent';

        } catch (Exception $e) {
            http_response_code(500);
            echo 'Message could not be sent.';
               echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        if ($mail->ErrorInfo) {
            return http_response_code(200);
        } else {
            return http_response_code(500);
        }
    }
}