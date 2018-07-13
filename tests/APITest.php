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

    public function testPingPong()
    {
        $env = Environment::mock([
            'SCRIPT_NAME' => '/index.php',
            'REQUEST_URI' => '/api/ping',
            'REQUEST_METHOD' => 'GET',
        ]);
        $req = Request::createFromEnvironment($env);
        $res = new Response();

        // Invoke process with optional arg
        $resOut = self::$appInstance->process($req, $res);

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $resOut);
        $this->assertEquals('pong', (string)$resOut->getBody());
    }

    public function testFailLogin()
    {
        $_POST = [];
        $_POST['login'] = 'foo';
        $_POST['password'] = 'bar';


        $env = Environment::mock([
            'SCRIPT_NAME' => '/index.php',
            'REQUEST_URI' => '/api/auth',
            'REQUEST_METHOD' => 'POST',
            'HTTP_CONTENT_TYPE' => 'multipart/form-data; boundary=---foo'
        ]);
        $req = Request::createFromEnvironment($env);
        $res = new Response();

        unset($_POST);

        // Invoke process with optional arg
        $resOut = self::$appInstance->process($req, $res);

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $resOut);
        $jsonResponse = json_decode((string)$resOut->getBody(), true);
        $this->assertEquals(false, $jsonResponse['success']);
    }

    public function testSuccessFullLogin()
    {
        $_POST = [];
        $_POST['login'] = '123';
        $_POST['password'] = '123';

        $env = Environment::mock([
            'SCRIPT_NAME' => '/index.php',
            'REQUEST_URI' => '/api/auth',
            'REQUEST_METHOD' => 'POST',
            'HTTP_CONTENT_TYPE' => 'multipart/form-data; boundary=---foo'
        ]);
        $req = Request::createFromEnvironment($env);
        $res = new Response();

        unset($_POST);

        // Invoke process with optional arg
        $resOut = self::$appInstance->process($req, $res);

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $resOut);
        $jsonResponse = json_decode((string)$resOut->getBody(), true);
        $this->assertEquals(true, $jsonResponse['success']);
        $this->assertTrue(isset($jsonResponse['user']));
    }
}
