<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployeControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/employes');

        $rep=$client->getResponse();
        $this->assertSame(200,$client->getResponse()->getStatusCode());
        //$this->assertJsonStringEqualsJsonString($jsonstring,$rep->getContent());
    }
    public function testAjoutOk()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/employe',[],[],
        ['CONTENT_TYPE'=>"application/json"],
        '{"matricule":"004","nom": "ndiaye","prenom": "baye","salaire": 2000000}');
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(201,$client->getResponse()->getStatusCode());
    }
    public function testAjoutKo()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/employe',[],[],
        ['CONTENT_TYPE'=>"application/json"],
        '{"matricule":"004","nom": "ndiaye","prenom": "","salaire": "iiii"}');
        $rep=$client->getResponse();
        var_dump($rep);
        $this->assertSame(200,$client->getResponse()->getStatusCode());
    }
}
