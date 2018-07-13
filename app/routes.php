<?php
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
        ->withHeader('Access-Control-Allow-Credentials', 'true');
});

// Routes
$app->get('/', function($request, $response) {
    return $response->withJson(['Pagina' => 'Home']);
});

$app->group('/api', function () {

    $this->get('/ping', '\App\Controller\UserController:pongAction')->setName('pong');

    $this->post('/auth', '\App\Controller\UserController:authAction')->setName('apiAuth');

    $this->group('', function () {
        $this->get('/me', '\App\Controller\UserController:meAction')->setName('apiMe');

        $this->group('/notebook', function () {
            $this->get('', '\App\Controller\NotebookController:getNotebooksAction')->setName('getNotebooks');
            $this->get('/{notebookId}/note', '\App\Controller\NotebookController:getNotebooksAction')->setName('getNotebooks');

        });

    })->add('\App\Middleware\AuthMiddleware');

});
