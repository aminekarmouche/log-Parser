<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

	public function testParse()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/parse');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

	public function testLogParse()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/logparse');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testLoad()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/load');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }



}
