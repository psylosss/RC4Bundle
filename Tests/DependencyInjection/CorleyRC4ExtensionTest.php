<?php
namespace Corley\RC4Bundle\Tests\DependencyInjection;

use ReflectionClass;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Corley\RC4Bundle\DependencyInjection\CorleyRC4Extension;

class CorleyRC4ExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $container;

    public function setUp()
    {
        $this->kernel = $this->getMock('Symfony\\Component\\HttpKernel\\KernelInterface');

        $this->container = new ContainerBuilder();

        $this->container->setParameter('rc4_key', "testkey");
    }

    public function testGetRC4Impl()
    {
        $extension = new CorleyRC4Extension();
        $extension->load(array(array()), $this->container);

        $this->assertInstanceOf('Corley\RC4\RC4', $this->container->get('corley_rc4.impl'));
    }

    public function testGetRC4MergeKeyFromServices()
    {
        $extension = new CorleyRC4Extension();
        $extension->load(array(array()), $this->container);

        $rc4 = $this->container->get('corley_rc4.impl');
        $this->assertInstanceOf('Corley\RC4\RC4', $rc4);

        $reflectionClass = new ReflectionClass($rc4);
        $reflectionProperty = $reflectionClass->getProperty('key');
        $reflectionProperty->setAccessible(true);

        $this->assertEquals("testkey", $reflectionProperty->getValue($rc4));
    }

    public function testGetRC4ImplUsingAlias()
    {
        $extension = new CorleyRC4Extension();
        $extension->load(array(array()), $this->container);

        $this->assertInstanceOf('Corley\RC4\RC4', $this->container->get('rc4'));
    }
}
