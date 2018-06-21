<?php

namespace App\Controller;

use App\Library\UnitProcessor;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{

    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function authAction(Request $request, Response $response, $args)
    {

        return $response->withJson(['auth' => 'doAuth']);
    }

    public function meAction(Request $request, Response $response, $args)
    {

        return $response->withJson(['me' => 'Usuario']);
    }

}