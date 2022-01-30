<?php

namespace App\Tests;

use App\Tests\Helper\Helper;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestaurantTest extends WebTestCase
{
    public function testAddRestaurant(): void
    {
        //En tant que Restaurateur, après m'être connecté,
        $restaurateur = static::createClient();
        $form = Helper::loginHelper($restaurateur, 'restaurateur@notaResto.fr', 'restaurateur');
        $restaurateur->submit($form);
        $restaurateur->followRedirect();

        //Lorsque j'arrive sur la page de gestion de mes restaurant
        $crawler = $restaurateur->request('GET', '/add/restaurant');
        $this->assertResponseIsSuccessful();

        //Je souhaite pouvoir ajouter un restaurant
    }
}
