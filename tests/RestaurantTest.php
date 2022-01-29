<?php

namespace App\Tests;

use App\Tests\Helper\Helper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestaurantTest extends WebTestCase
{
    public function testSomething(): void
    {
        //En tant que Restaurateur, après m'être connecté,
        $client = static::createClient();
        $form = Helper::loginHelper($client, 'client@notaResto.fr', 'client');
        $client->submit($form);
        $client->followRedirect();

        //Lorsque j'arrive sur la page de gestion de mes restaurant
        $crawler = $client->request('GET', '/add/restaurant');
        $this->assertResponseIsSuccessful();

        //Je souhaite pouvoir ajouter un restaurant
    }
}
