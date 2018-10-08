<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 20/09/2018
 * Time: 00:35
 */

namespace App\Services\Factory;


use App\Services\Post\InsertPostService;

class ServiceProvider
{

    protected function __construct()
    {
    }

    //tao 1 mang cac providers dung cho class ServiceFactory
    public static function register() {
        return [
            'delete_category'=>\App\Services\Category\DeleteCategoryService::class,
            'insert_category'=>\App\Services\Category\InsertCategoryService::class,
            'insert_post'=>\App\Services\Post\InsertPostService::class,
            'update_sevice'=>\App\Services\Post\UpdatePostService::class,
        ];
    }

}