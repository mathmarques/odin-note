<?php

namespace App\Controller;

use App\Library\UnitProcessor;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{

    private $container;

    public function __construct(\Container $container)
    {
        $this->container = $container;
    }

    public function authAction(Request $request, Response $response, $args)
    {
        $apiResponse = $this->container->fullAPI->doLogin(
            $request->getParsedBodyParam('login'),
            $request->getParsedBodyParam('password'));


        if($apiResponse == null)
            return $response->withJson(['success' => false, 'message' => 'Usuário inválido'], 400);

        $_SESSION['user'] = $apiResponse;

        return $response->withJson(['success' => true, 'user' => $apiResponse, 'message' => 'Usuário logado']);
    }

    public function pongAction(Request $request, Response $response, $args)
    {
        return $response->write('pong');
    }

    public function meAction(Request $request, Response $response, $args)
    {
        return $response->withJson(['success' => true, 'me' => $_SESSION['user'], 'message' => 'Usuário logado']);
    }

}