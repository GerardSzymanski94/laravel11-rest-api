<?php

namespace App\Services;

use App\Enums\AtomServiceAuthStatusEnum;
use SoapClient;
use Exception;
use stdClass;
class AtomStoreService implements IApiService
{
    private $url, $login, $password, $client, $authenticate;
    public function __construct()
    {
        $this->url = config('atom_store.url');
        $this->login = config('atom_store.login');
        $this->password = config('atom_store.password');

        if(!isset($this->url) || !isset($this->login) || !isset($this->password)){
            throw new Exception("Atom url, login and password are required");
        }

        $this->client = new SoapClient($this->url);
        $this->authenticate = array('login' => $this->login, 'password' => $this->password);

        if($this->auth() != AtomServiceAuthStatusEnum::OK){
            throw new Exception("Atom url, login or password is incorrect");
        }
    }

    public function auth(): ?AtomServiceAuthStatusEnum{
        $response = $this->client->CheckConnection($this->authenticate);
        return AtomServiceAuthStatusEnum::tryFrom($response) ?? null;
    }

    public function getOrders(): stdClass
    {
        $response = $this->client->GetOrders($this->authenticate);
        return json_decode(json_encode(simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)));
    }

    public function getOrder(int $id): stdClass
    {
        $response = $this->client->GetOrdersSpecified($this->authenticate, '', $id, 1);
        return json_decode(json_encode(simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)));
    }
    public function getProduct(string $code): stdClass
    {
        $response = $this->client->GetProductByCode($this->authenticate, $code);
        return json_decode(json_encode(simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)));
    }

}
