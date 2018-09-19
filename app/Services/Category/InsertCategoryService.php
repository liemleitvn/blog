<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 10/09/2018
 * Time: 15:47
 */

namespace App\Services\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;


class InsertCategoryService
{
    private $data;
    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * @param array $data
     * @return $this
     * Get data from CategoryController
     */
    public function setData (array $data) {
        $this->data = $data;
        return $this;
    }

    /**
     * @return bool
     * Execute insert category in database
     */
    public function execute () {
        $getAllCategory = $this->categoryRepo->all()->toArray();
        foreach ($getAllCategory as $category) {
            //is exist database
            if($category['name']==$this->data['name']) {
                return false;
            }
        }
        $this->categoryRepo->create($this->data);
        return true;
    }
}

?>