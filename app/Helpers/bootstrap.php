<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 20/09/2018
 * Time: 00:45
 */

function service ($provider) {
    return \App\Services\Factory\ServiceFactory::create($provider);
}

