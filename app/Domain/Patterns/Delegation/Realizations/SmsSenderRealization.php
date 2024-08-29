<?php

namespace App\Domain\Patterns\Delegation\Realizations;
use App\Domain\Patterns\Delegation\Abstracts\SenderRealizationAbstract;
use Domain\Patterns\Delegation\Interfaces\SenderInterface;

class SmsSenderRealization extends SenderRealizationAbstract implements SenderInterface
{

    /**
     * @return bool
     */
    public function send(): bool
    {
        ray('send by sms')->blue();
        return true;

    }

}
