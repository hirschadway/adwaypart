<?php 
namespace App\Subscribers\Models;

use App\Events\Models\Shop\ShopCreated;
use Illuminate\Events\Dispatcher;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;

class ShopSubscriber
{
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ShopCreated::class,SendEmailMessage::class);
    }
}