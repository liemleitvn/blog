<?php 

namespace App\Repositories\Contracts;

interface PostRepositoryInterface 
{
    public function get ($keyword, $offset = 0, $limit = 10);

    public function getPostByTitle($keyword, $offset = 0, $limit = 100);

}

 ?>