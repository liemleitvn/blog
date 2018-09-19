<?php 
namespace App\Repositories\Eloquents;


use App\Repositories\Eloquents\EloquentAbstract;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Models\Post;
/**
 * 
 */
class PostRepository extends EloquentAbstract implements PostRepositoryInterface
{
	protected $model;

	function __construct(Post $post)
	{

		$this->model = $post;

	}

	function deletePostByCategoryId($categoryId)
    {
        // TODO: Implement deletePostByCategoryId() method.

    }
}

 ?>