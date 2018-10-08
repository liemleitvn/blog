<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index() {
        try {
            $result = $this->categoryRepo->all()->toArray();
            if(count($result)>0) {
                return response()->json($result, 200);
            }
            else {
                return response()->json(['meseage'=>'The posts is not already.'], 404);
            }
        }
        catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function show ($id) {
        try {
            $result = $this->categoryRepo->find($id);
            if($result) {
                return response()->json($result, 200);
            }
            else {
                return response()->json(['error'=>'The posts is not already.'], 404);
            }
        }
        catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function store(Request $request) {


    }

    public function update(Request $request, $id) {

    }

    public function edit (Request $request, $id) {

    }


    public function delete($id) {

    }
}
