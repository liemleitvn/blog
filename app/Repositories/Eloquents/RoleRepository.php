<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 28/11/2018
 * Time: 13:43
 */

namespace App\Repositories\Eloquents;


use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository extends EloquentAbstract implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

}