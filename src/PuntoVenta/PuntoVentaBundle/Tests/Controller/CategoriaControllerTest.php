<?php

namespace PuntoVenta\PuntoVentaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriaControllerTest extends WebTestCase
{
    public function testMostrarCategorias(){

        $client = static::createClient();

        $client->enableProfiler();

        $client->request('GET', '/categoria/');

        if ($profile = $client->getProfile()) {


            $duracionPeticion = $profile->getCollector('time')->getDuration();

            $this->assertLessThan(
                2,
                $profile->getCollector('db')->getQueryCount()
            );


            $this->assertLessThan(
                3000, // 1 seg = 10,000
                $duracionPeticion,
                'Duracion de la peticion: ' . $duracionPeticion
            );
        }
    }

	public function testAgregarCategoria(){
		
		$client = static::createClient();		
		
		$crawler = $client->request('GET', '/categoria/new');		
		
		$form = $crawler->selectButton('Agregar')->form(array(
				'puntoventa_puntoventabundle_categoriatype[nombre]'  => 'Categoria Unit Test',
		));
		
		$client->submit($form);

        $this->assertEquals(
            302, $client->getResponse()->getStatusCode()
        );


        $this->assertTrue(
				$client->getResponse()->isRedirect('/categoria/')
		);
	}

    public function testCategoria(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/categoria/1/edit');
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Categoria")')->count()
        );

    }
	
	
	
	
    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/categoria/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /categoria/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'puntoventa_puntoventabundle_categoriatype[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'puntoventa_puntoventabundle_categoriatype[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}