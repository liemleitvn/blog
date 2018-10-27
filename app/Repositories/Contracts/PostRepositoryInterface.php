<?php 

namespace App\Repositories\Contracts;

interface PostRepositoryInterface 
{
    public function get ($keyword, $offset = 0, $limit = 10);


}

 ?>