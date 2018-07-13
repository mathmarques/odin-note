<?php

namespace App\Library;

use GuzzleHttp\Client;

class FullTeachingAPI
{

    private $client;

    public function __construct(){
        $this->client = new Client(array('base_uri' => 'http://direct.matheusmarques.com:4711/'));
    }

    public function doLogin($login, $password)
    {
        $response = $this->client->request('POST', '/users/login', [
            'form_params' => [
                'login' => $login,
                'password' => $password,
            ]
        ]);

        $jsonResponse = json_decode((string) $response->getBody(), true);

        if($jsonResponse['success'])
            return $jsonResponse['user'];

        return null;
    }

    public function getNotebooks($userId)
    {
        $response = $this->client->request('GET', '/users/'.$userId.'/notebooks');

        $jsonResponse = json_decode((string) $response->getBody(), true);

        if($jsonResponse['success'])
            return $jsonResponse['notebooks'];

        return null;
    }

}