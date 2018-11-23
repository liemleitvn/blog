<?php 
namespace App\Repositories\Eloquents;


use App\Repositories\Eloquents\EloquentAbstract;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Models\Post;
use function GuzzleHttp\Promise\all;

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

    /**
     * Get posts by keyword
     * @author Liem Le <liemleit@gmail.com>
     * @param string $keyword
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
	public function get($keyword = "", $offset = 0, $limit = 10)
    {

        if($keyword == "") {
            return $this->model->skip($offset)->take($limit)->orderBy('created_at', 'desc')->get();
        }

        $result =  $this->model->where(function ($query) use ($keyword) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('content', 'LIKE', "%{$keyword}%");
        })->skip($offset)->take($limit)->get();

        return $result;

    }

    public function getPostByTitle($keyword = "", $offset = 0, $limit = 100)
    {
        if($keyword =="") {
            return $this->model->skip($offset)->take($limit)->orderBy('created_at', 'desc')->get();
        }

        $posts = $this->model->where('title','LIKE', "%$keyword%")->skip($offset)->take($limit)->get();

        return $posts;
    }
}

 ?>