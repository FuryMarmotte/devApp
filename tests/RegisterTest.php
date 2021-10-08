<?php

namespace App\Tests;

use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\PantherTestCase;

class RegisterTest extends PantherTestCase
{
    public function testSomething(): void
    {
        $client = static::createPantherClient();
        /*$client = Client::createChromeClient(null, [
            "--windows-size=1200,1100",
            "--proxy-server=http://proxy-sh.ad.campus-eni.fr:8080",
            "--headless",
            "--disable-gpu"
        ]);
        */
        $crawler = $client->request('GET', '/register');
        $crawler->filter('#registration_form_pseudo')->sendKeys('BobMorane');
        $client->wait(5);
        $this->assertPageTitleContains('Enregistrement');
        // $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
