<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 19/09/2018
 * Time: 10:14
 */

namespace App\Services\Factory;

use App\Services\Category\DeleteCategoryService;
use App\Services\Category\InsertCategoryService;

class ServiceFactory
{

    public static $category = [
        'insert'=> InsertCategoryService::class,
        'delete'=> DeleteCategoryService::class,
    ];


    public static function create ($action) {

        if(!array_key_exists($action, ServiceFactory::$category)) {
            throw new  \Exception('Action is invalid!');
        }
        return app(ServiceFactory::$category[$action]);
    }
}