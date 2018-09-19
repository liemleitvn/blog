<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 10/09/2018
 * Time: 18:29
 */

namespace App\Services\Category;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Events\TransactionBeginning;
use DB;
use App\Repositories\Contracts\PostRepositoryInterface;


class DeleteCategoryService
{

    private $categoryRepo;
    private $postRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo, PostRepositoryInterface $postRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->postRepo = $postRepo;
    }



    public function execute ($id) {
        // Start transaction!
        DB::beginTransaction();
        try {
            $this->postRepo->delete($id, 'category_id');
            $this->categoryRepo->delete($id);

        }
        catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;

    }

}