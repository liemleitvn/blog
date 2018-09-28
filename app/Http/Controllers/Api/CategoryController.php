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

    }

    public function show ($id) {

    }

    public function store(Request $request) {
        $data = array();

    }

    public function update(Request $request, $id) {

    }

    public function edit (Request $request, $id) {

    }


    public function delete($id) {

    }
}
