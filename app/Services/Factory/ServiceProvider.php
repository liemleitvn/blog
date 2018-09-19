<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 20/09/2018
 * Time: 00:35
 */

namespace App\Services\Factory;


class ServiceProvider
{

    protected function __construct()
    {
    }

    public static function register() {
        return [
            'delete_category'=>\App\Services\Category\DeleteCategoryService::class,
            'insert_category'=>\App\Services\Category\InsertCategoryService::class,
        ];
    }

}