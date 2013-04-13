<?php
/**
 * Created by JetBrains PhpStorm.
 * User: aleks
 * Date: 4/13/13
 * Time: 1:05 AM
 * To change this template use File | Settings | File Templates.
 */

namespace PuntoVenta\PuntoVentaBundle\Tests\Repositories;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductoRepositoryTest extends WebTestCase {
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }


    public function testGetProducto(){

        $producto = $this->em->getRepository('PuntoVentaBundle:Producto')
            ->getFirstProductoOfFirstCategory();

        $this->assertNotNull($producto->getId());

    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }
}