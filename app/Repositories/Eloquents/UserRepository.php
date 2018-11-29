<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 29/11/2018
 * Time: 11:18
 */

namespace App\Repositories\Eloquents;


use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends EloquentAbstract implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }



    public function get($keyword = [], $offset = 0, $limit = 10, $paginate = 0)
    {

        if(count($keyword) == 0) {
            if($paginate == 0) {
                return $this->model->skip($offset)->take($limit)->orderBy('created_at', 'desc')->get();
            }
            return $this->paginate($paginate);
        }

        if($paginate == 0) {
            $result =  $this->model->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('content', 'LIKE', "%{$keyword}%");
            })->skip($offset)->take($limit)->get();

            return $result;
        }

        $result =  $this->model->where(function ($query) use ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%");
        })->paginate($paginate);

        return $result;

    }

}