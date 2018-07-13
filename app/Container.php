<?php

/**
 * @property \App\Library\FullTeachingAPI fullAPI
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
                return $response->withJson(['success'=>false, 'error' => 'Not Found'])->withStatus(404);
            };
        };

        $this['fullAPI'] = function () {
            return new \App\Library\FullTeachingAPI();
        };

    }

}