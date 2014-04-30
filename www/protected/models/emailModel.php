<?php
class emailModel {
    public function sendEmail($email, $msg) {

        /*$escape_msg = htmlspecialchars(strip_tags(stripslashes(trim($msg))));*/

        $to = $email;

        $subject = "Покупки билета на сайте: " . Yii::app()->name;

        $message = $msg . "\r\n";

        $headers = "From: Ticket.socode.ru <".Yii::app()->params['adminEmail'].">\r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";

        $sendingResult = mail($to, $subject, $message, $headers);

        if ($sendingResult) {
            return true;
        } else {
            return false;
        }
    }
}