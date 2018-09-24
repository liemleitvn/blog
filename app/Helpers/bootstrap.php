<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 20/09/2018
 * Time: 00:45
 */

//file nay se duoc register tai Providers\HelperServiceProvider::class

//dung de thay the viec goi function static create cua service factory


function service ($provider) {
    return \App\Services\Factory\ServiceFactory::create($provider);
}
