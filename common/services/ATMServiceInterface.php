<?php

namespace common\services;

interface ATMServiceInterface
{
    /**
     * @param string $cityName
     * @return array
     */
    public function getList(string $cityName): array;

    /**
     * @return void
     */
    public function setService();
}