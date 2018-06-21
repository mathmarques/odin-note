<?php

use App\Persistence\UserDAO;
use \Doctrine\ORM\EntityManager;
use Slim\Views\Smarty;

/**
 * @property EntityManager db
 * @property UserDAO userDAO
 */
class Container extends \Slim\Container
{
    public function __construct(array $values = [])
    {
        parent::__construct($values);

        $this->registerDependencies();
    }

    private function registerDependencies() {

        //Not Found
        $this['notFoundHandler'] = function () {
            return function ($request, $response) {
                return $response->withJson(['error' => 'Not Found'])->withStatus(404);
            };
        };

        //Doctrine
        $this['db'] = function () {
            $settings = $this->settings;

            $config = new \Doctrine\ORM\Configuration();
            $config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
            $driverImpl = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(new \Doctrine\Common\Annotations\AnnotationReader(),
                $settings['doctrine']['model']);
            \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
            $config->setMetadataDriverImpl($driverImpl);
            $config->setQueryCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
            $config->setProxyDir($settings['doctrine']['cache_proxy']);
            $config->setProxyNamespace('App\Cache\Proxies');

            $config->setAutoGenerateProxyClasses(true);

            return EntityManager::create($settings['db'], $config);
        };

        //Doctrine DAOs
        $this['userDAO'] = function () {
            return new UserDAO($this->db);
        };

    }

}