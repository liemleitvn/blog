<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 24/10/2018
 * Time: 17:56
 */

namespace App\Services\Post;


use App\Repositories\Contracts\PostRepositoryInterface;


class GetPostService
{

    private $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;

    }

    public function execute($keyword = "", $page = 1) {

        $limit = config("list.limit");
        $offset = ($page-1)*$limit;

        return $this->postRepo->get($keyword,$offset,$limit);

    }





}