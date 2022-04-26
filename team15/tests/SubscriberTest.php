<?php

use SRC\Subscriber;
use PHPUnit\Framework\TestCase;

class SubscriberTest extends TestCase
{
    public function testSubscribe()
    {
        $subscriber = new Subscriber();
        $data = [
            "name" => 'Martina Pani',
            "email" => 'm94.pani@gmail.com',
        ];
        $this->assertTrue($subscriber->subscribe($data) != false, "Unable to subscribe");
    }
}
