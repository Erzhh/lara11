<?php

namespace Domain\Patterns\Delegation\Realizations;
use App\Domain\Patterns\Delegation\Abstracts\SenderRealizationAbstract;
use Domain\Patterns\Delegation\Interfaces\SenderInterface;

class EmailSenderRealization extends SenderRealizationAbstract implements SenderInterface
{

    public function send():bool
    {
        ray('send by email')->purple();

        return true;
    }

}
