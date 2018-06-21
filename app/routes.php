<?php

// Routes
$app->get('/', function($request, $response) {
    return $response->withJson(['Pagina' => 'Home']);
});


$app->group('/api', function () {

    $this->get('/auth', '\App\Controller\UserController:authAction')->setName('apiAuth');

    $this->group('', function () {
        $this->get('/me', '\App\Controller\UserController:meAction')->setName('apiMe');
    })->add('\App\Middleware\AuthMiddleware');

});
