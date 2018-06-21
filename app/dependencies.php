<?php
// DIC configuration

$container = $app->getContainer();

$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        return $container->get('view')->render($response, '404.tpl')->withStatus(404);
    };
};
