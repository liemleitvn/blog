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
        $providers = ServiceProvider::register();
        if(!isset($providers[$provider])) {
            throw new ServiceException("Provider {$provider} is not found!");
        }

        $nameClass = $providers[$provider];

        if (!class_exists($nameClass)) {
            throw new ServiceException("Class {$nameClass} is not found!");
        }

        return app($nameClass);
    }

}