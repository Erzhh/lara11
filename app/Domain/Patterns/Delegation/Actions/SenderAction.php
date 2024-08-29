<?php

namespace App\Domain\Patterns\Delegation\Actions;
use App\Domain\Patterns\Delegation\Abstracts\Sender;

class SenderAction
{

    public function run()
    {

        $sender = new Sender();
        $sender->toSms()
                ->setRecipients(['a@gmail.com'])
                ->setSender('sender@gmail.com')
                ->send();

        $sender->toEmail()
            ->setRecipients(['a@gmail.com'])
            ->setSender('sender@gmail.com')
            ->send();

    }

}
