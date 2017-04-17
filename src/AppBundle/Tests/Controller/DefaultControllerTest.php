<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
  public function testIndex()
  {
    $client = static::createClient();

    $crawler = $client->request('GET', '/');

    $this->assertEquals(200, $client->getResponse()->getStatusCode());
  }

  public function test404()
  {
    $client = static::createClient();

    $crawler = $client->request('GET', '/_error/404');

    $this->assertContains("Page non trouvée", $client->getResponse()->getContent());
  }

  public function test500()
  {
    $client = static::createClient();

    $crawler = $client->request('GET', '/_error/500');

    $this->assertContains("Erreur", $client->getResponse()->getContent());
  }

}
