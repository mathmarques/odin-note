<?php

namespace App\Controller;

use App\Library\UnitProcessor;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class NotebookController
{

    private $container;

    public function __construct(\Container $container)
    {
        $this->container = $container;
    }

    public function getNotebooksAction(Request $request, Response $response, $args)
    {
        $apiResponse = $this->container->fullAPI->getNotebooks($_SESSION['user']['id']);

        if($apiResponse == null)
            return $response->withJson(['success' => false, 'message' => 'Erro ao buscar notebooks'], 400);


        return $response->withJson(['success' => true, 'notebooks' => $apiResponse, 'message' => 'Lista de notebooks']);
    }


}