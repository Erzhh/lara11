<?php

namespace App\Domain\Patterns\Delegation\Abstracts;
use App\Domain\Patterns\Delegation\Realizations\SmsSenderRealization;
use Domain\Patterns\Delegation\Interfaces\SenderInterface;
use Domain\Patterns\Delegation\Realizations\EmailSenderRealization;

class Sender implements SenderInterface
{
    public SenderInterface $messager;
    public function __construct()
    {
        $this->messager = new EmailSenderRealization();
    }

    public function toEmail()
    {
        $this->messager = new EmailSenderRealization();
        return $this;
    }

    public function toSms()
    {
        $this->messager = new SmsSenderRealization();
        return $this;
    }

    /**
     * @return SenderInterface
     * @param array<string> $recipients
     */
    public function setRecipients(array $recipients): SenderInterface
    {
        $this->messager->setRecipients( $recipients );
        return $this->messager;
    }

    /**
     * @return SenderInterface
     * @param string $sender
     */
    public function setSender(string $sender): SenderInterface
    {
        $this->messager->setSender( $sender );
        return $this->messager;
    }

    /**
     * @return void
     */
    public function send(): bool
    {
        $this->messager->send();
    }

}
