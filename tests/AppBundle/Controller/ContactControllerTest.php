<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{

  public function __construct(Type $uri = null)
  {
    $this->uri = 'contact';
  }

  public function testContact()
  {
      $client = static::createClient();

      $crawler = $client->request('GET', $this->uri);

      $this->assertEquals(200, $client->getResponse()->getStatusCode());
  }

  public function testContactSubmit()
  {
      $client = static::createClient();

      $crawler = $client->request('GET', $this->uri);

      $this->assertEquals(200, $client->getResponse()->getStatusCode());

      $form = $crawler->selectButton('form_submit')->form();
      $crawler = $client->submit($form, array('form[name]' => 'Fabien'));

  }
}