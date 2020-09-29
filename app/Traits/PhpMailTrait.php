<?php

namespace App\Traits;


trait PhpMailTrait{

    private string $to;
    private string $subject;
    private string $message;
    private array $headers = [];

    /**
     * Задає адресу отримквача
     * @param string $to
     * @return $this
     */
    private function setTo(string $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * Передати масив з заголовками, (ключ - заголовок => значення)
     * @param array $headers
     * @return $this
     */
    private function setMailHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }


    /**
     * Задає тему листа
     * @param string $subject
     * @return $this
     */
    private function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Встановлює заголовок From
     * @param string $from
     * @return $this
     */
    private function stMailFrom(string $from)
    {
        $this->headers['From'] = $from;
        return $this;
    }

    /**
     * Викому відправку методом php mail()
     * @param string $message
     * @return bool
     */
    private function sendMail(string $message):bool
    {
        return mail($this->to, $this->subject, $message);
    }
}
