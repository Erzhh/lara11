<?php

namespace App\Domain\Patterns\Delegation\Abstracts;
use Domain\Patterns\Delegation\Interfaces\SenderInterface;

abstract class SenderRealizationAbstract implements SenderInterface
{
    protected array $recipients;
    protected string $sender;

    /**
     * @return SenderInterface
     * @param array $recipients
     */
    public function setRecipients(array $recipients): SenderInterface
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return SenderInterface
     * @param string $sender
     */
    public function setSender(string $sender): SenderInterface
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        return true;
    }
}
