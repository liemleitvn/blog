<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\AuthJWT;
use App\Models\Post;
use Hamcrest\Thingy;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use JWTAuth;
use App\Http\Resources\PostResource;
use JWTAuthException;

class PostController extends Controller
{
    private $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index() {

        $search = \request('search', '');
        $page = \request('page', 1);

        try {
            $result = service('get_post')->execute($search, $page);
            if(count($result)>0) {
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

    public function show ($id) {
        try {
            $result = $this->postRepo->find($id);
            if($result) {
                return response()->json([new PostResource($result)], 200);
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



        //check request
        if ($request->has('title') && $request->has('category') && $request->has('content')) {
            return service('insert_post')->execute($request);
        }
        else {
            return response()->json(['error'=>'Check again request information'],400);
        }
    }

    //Handler patch api
    public function edit(Request $request, $id) {

        if ($request->has('title') && $request->has('category') && $request->has('content')) {
            return service('update_sevice')->execute($request, $id);
        }
        else {
            return response()->json(['error'=>'Check again request information'],400);
        }
    }

    public function update (Request $request, $id) {

    }


    public function delete($id) {
        $checkPost = $this->postRepo->find($id);
        if($checkPost) {
            $this->postRepo->delete($id);
            return response()->json([],204);
        }
        else {
            return response()->json(['error'=>'The post is not exist.'],400);
        }
    }

    public function search ($keyword) {
        try {
            $result = service('search_post')->execute($keyword);

            return response()->json($result);
        }
        catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
