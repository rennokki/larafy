<?php

namespace Rennokki\Larafy\Test;

class LarafyTest extends TestCase
{
    public function testMarket()
    {
        $this->assertEquals($this->api->market, 'US');

        $this->api->setMarket('RO');
        $this->assertEquals($this->api->market, 'RO');
    }

    public function testLocale()
    {
        $this->assertEquals($this->api->locale, 'en_US');

        $this->api->setLocale('ro_RO');
        $this->assertEquals($this->api->locale, 'ro_RO');
    }
}
