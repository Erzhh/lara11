<?php

namespace Domain\Patterns\Delegation\Interfaces;

interface SenderInterface
{
    /**
     * @return SenderInterface
     * @param array<string> $recipients
     */
    public function setRecipients(array $recipients): SenderInterface;

    /**
     * @return SenderInterface
     * @param string $sender
     */
    public function setSender(string $sender): SenderInterface;

    /**
     * @return void
     */
    public function send(): bool;
}
