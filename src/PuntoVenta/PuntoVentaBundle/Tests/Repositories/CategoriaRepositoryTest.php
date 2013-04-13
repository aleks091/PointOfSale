<?php
/**
 * Created by JetBrains PhpStorm.
 * User: aleks
 * Date: 4/12/13
 * Time: 10:23 PM
 * To change this template use File | Settings | File Templates.
 */

namespace PuntoVenta\PuntoVentaBundle\Tests\Repositories;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriaRepositoryTest extends WebTestCase {

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


    public function testGetCategorias(){

        $categorias = $this->em->getRepository('PuntoVentaBundle:Categoria')
            ->getCategoriasByNombreResult();

        $this->assertGreaterThan(0, $categorias->count());

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