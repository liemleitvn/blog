<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 29/11/2018
 * Time: 11:17
 */

namespace App\Repositories\Contracts;


interface UserRepositoryInterface
{
    public function get($keyword = [], $offset = 0, $limit = 10, $paginate = 0);
}