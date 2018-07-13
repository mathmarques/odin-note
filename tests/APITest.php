<?php
use PHPUnit\Framework\TestCase;
use Slim\Http\Uri;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\RequestBody;
use Slim\Http\Request;
use Slim\Http\Response;

class APITest extends TestCase
{
    /** @var \Slim\App $app */
    public static $appInstance;

    public static function setUpBeforeClass()
    {
        session_start();

        // Set up dependencies Instantiate the app
        require  __DIR__ . '/../app/Container.php';
        $settings = require __DIR__ . '/../app/settings.php';
        $app = new \Slim\App(new Container($settings));
        // Register routes
        require __DIR__ . '/../app/routes.php';

        self::$appInstance = $app;
    }

    public function testTestOne()
    {
        $env = Environment::mock([
            'SCRIPT_NAME' => '/index.php',
            'REQUEST_URI' => '/api/ping',
            'REQUEST_METHOD' => 'GET',
        ]);
        $uri = Uri::createFromEnvironment($env);
        $headers = Headers::createFromEnvironment($env);
        $cookies = [];
        $serverParams = $env->all();
        $body = new RequestBody();
        $req = new Request('GET', $uri, $headers, $cookies, $serverParams, $body);
        $res = new Response();

        // Invoke process with optional arg
        $resOut = self::$appInstance->process($req, $res);

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $resOut);
        $this->assertEquals('pong', (string)$resOut->getBody());
    }
}
