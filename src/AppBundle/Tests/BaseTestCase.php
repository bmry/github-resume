<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/11/2019
 * Time: 9:32 AM
 */

namespace AppBundle\Tests;


use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BaseTestCase extends  WebTestCase
{
    /** @var Container */
    protected $container;

    /** @var Client */
    protected $client;

    public function setUp(){
        $this->client = static::createClient();
        $this->container = self::$kernel->getContainer();
        $this->entityManager = $this->container->get('doctrine')->getManager();

    }


    public function generateUrl($route, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        $uri = $this->container->get('router')->generate($route, $parameters, $referenceType);
        $uri = str_ireplace('/app_dev.php', '', $uri);

        return $uri;
    }


    protected function trans($string, $params = [], $domain = null)
    {
        return $this->container->get('translator')->trans($string, $params, $domain);
    }
}