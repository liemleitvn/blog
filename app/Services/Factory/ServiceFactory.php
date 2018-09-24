<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 20/09/2018
 * Time: 00:34
 */

namespace App\Services\Factory;


class ServiceFactory
{
    protected function __construct()
    {
    }

    public static function create ($provider) {
        //Lay mang provider trong class ServiceProvider
        $providers = ServiceProvider::register();

        if(!isset($providers[$provider])) {
            throw new ServiceException("Provider {$provider} is not found!");
        }

        //Lay class cu the de khoi tao doi tuong
        $nameClass = $providers[$provider];

        if (!class_exists($nameClass)) {
            throw new ServiceException("Class {$nameClass} is not found!");
        }

        return app($nameClass); //khoi tao doi tuong
    }

}