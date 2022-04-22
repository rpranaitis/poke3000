<?php

namespace App\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    /**
     * @var PHPMailer
     */
    protected PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = true;
        $this->mailer->SMTPSecure = getenv('MAIL_ENCRYPTION');
        $this->mailer->Port = getenv('MAIL_PORT');
        $this->mailer->Host = getenv('MAIL_HOST');
        $this->mailer->Username = getenv('MAIL_USERNAME');
        $this->mailer->Password = getenv('MAIL_PASSWORD');
        $this->mailer->setFrom(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'));
        $this->mailer->isHTML(true);
    }
}