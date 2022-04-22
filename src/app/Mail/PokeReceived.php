<?php

namespace App\Mail;

use PHPMailer\PHPMailer\Exception;

class PokeReceived extends Mailer
{
    /**
     * @param string $to
     * @param string $username
     * @return bool
     */
    public function send(string $to, string $username): bool
    {
        try {
            $content = "<strong>{$username}</strong> siunčia tau poke.";

            $this->mailer->addAddress($to);
            $this->mailer->Subject = 'Gavai poke!';
            $this->mailer->msgHTML($content);

            $this->mailer->send();
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}