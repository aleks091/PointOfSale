<?php
/**
 * Created by JetBrains PhpStorm.
 * User: aleks
 * Date: 4/16/13
 * Time: 10:17 AM
 * To change this template use File | Settings | File Templates.
 */

namespace PuntoVenta\PuntoVentaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VentaUnitariaControllerTest extends WebTestCase {

    public function testAddUnitSale(){
        $client = static::createClient();
        $crawler = $client->request('GET', '/ventaunitaria/new');
        $this->assertTrue(true);
    }

}
