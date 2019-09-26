<?php

namespace common\services;

use yii\base\BaseObject;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\httpclient\Request;
use yii\httpclient\Response;

class PbAtmService extends BaseObject implements ATMServiceInterface
{
    private const HTTP_STATUS_OK = 200;

    /**
     * Privat bank ATM api url
     */
    protected const SERVICE_URL = 'https://api.privatbank.ua/p24api/infrastructure?json&atm';

    /**
     * @var Request
     */
    protected $request;


    public function __construct(Client $client, $config = [])
    {
        parent::__construct($config);
        $this->request = $client->get(
            static::SERVICE_URL, [],
            ['content-type' => 'application/json'], []
        );
    }

    /**
     * @param string $cityName
     * @return array
     * @throws \yii\httpclient\Exception
     */
    public function getList(string $cityName): array
    {
        $city = $cityName ?? '';
        /**
         * @var $response Response
         */
        $response = $this->request->addData(compact('city'))->send();

        if (!$response->getStatusCode() === self::HTTP_STATUS_OK) {
            return [];
        }

        return Json::decode($response->content, true);
    }

    /**
     * @return void
     */
    public function setService()
    {
        // TODO: Implement setService() method.
    }
}