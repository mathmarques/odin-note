<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class AuthMiddleware
{
    private $container;

    public function __construct(\Container $container)
    {
        $this->container = $container;
    }

    public function __invoke(Request $request, Response $response, callable $next)
    {

        if (!isset($_SESSION['user'])) {
            return $response->withJson(['success' => false, 'error' => 'Usuario não logado'], 400);
        }

        $newRequest = $request->withAttribute('user', $_SESSION['user']);

        return $next($newRequest, $response);
    }
}
