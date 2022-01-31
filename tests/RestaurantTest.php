<?php

namespace App\Tests;

use App\Tests\Helper\Helper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestaurantTest extends WebTestCase
{
    public function testAddRestaurant(): void
    {
        //En tant que Restaurateur, après m'être connecté,
        $client = static::createClient();
        $form = Helper::loginHelper($client, 'restaurateur@notaResto.fr', 'restaurateur');
        $client->submit($form);
        $client->followRedirect();

        //Lorsque j'arrive sur la page d'ajout d'un restaurant
        $crawler = $client->request('GET', '/add/restaurant');
        $this->assertResponseIsSuccessful();

        //Je souhaite pouvoir ajouter un restaurant
        $form = $crawler->selectButton('Ajouter')->form([
            'restaurant[postalCode]' => '63000',
            'restaurant[image]' => 'https://picsum.photos/300',
            'restaurant[nomRestaurant]' => 'Resto',
        ]);

        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div', 'Le restaurant a été ajouter');
    }

    public function testDashBoardRestaurant(): void
    {
        //En tant que Restaurateur, après m'être connecté, 
        $client = static::createClient();
        $form = Helper::loginHelper($client, 'restaurateur@notaResto.fr', 'restaurateur');
        $client->submit($form);
        $client->followRedirect();

        //Lorsque j'arrive sur la page de gestion de mes restaurant
        $crawler = $client->request('GET', '/restaurants');
        $this->assertResponseIsSuccessful();

        //Je souhaite pouvoir modifier mes restaurants
        // $form = $crawler->selectButton('Ajouter')->form([
        //     'restaurant[postalCode]' => '63000',
        //     'restaurant[image]' => 'https://picsum.photos/300',
        //     'restaurant[nomRestaurant]' => 'Resto',
        // ]);

        // $client->submit($form);
        // $crawler = $client->followRedirect();
        // $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('div', 'Le restaurant a été mis à jour');
    }
}
