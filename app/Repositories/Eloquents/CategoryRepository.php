<?php 

	namespace App\Repositories\Eloquents;

	use App\Models\Category;
	use App\Repositories\Contracts\CategoryRepositoryInterface;
	use App\Repositories\Eloquents\EloquentAbstract;

	/**
	 * 
	 */
	class CategoryRepository extends EloquentAbstract implements CategoryRepositoryInterface
	{
		protected $model;
		
		function __construct(Category $category)
		{
			$this->model = $category;
		}

		 public function getPostByCategoryId($id)
        {
           return $this->model->where('id', $id)->with('posts')->get();

        }
	}

 ?>