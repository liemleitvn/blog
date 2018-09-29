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
        try {
            $result = $this->postRepo->all()->toArray();
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
            $result = $this->postRepo->find($id);
            if($result) {
                return response()->json([new PostResource($result)], 200);
            }
            else {
                return response()->json(['error'=>'The posts is not already.'], 404);
            }
        }
        catch (\Exception $e) {
            return \response()->json($e);
        }
    }

    public function store(Request $request) {


        //check request
        if ($request->has('title') && $request->has('category') && $request->has('content')) {
            return service('insert_post')->execute($request);
        }
        else {
            return response()->json(['message'=>'Check again request information'],400);
        }
    }

    public function update(Request $request, Post $post, $id) {

        if ($request->user()->id !== $post->user_id) {
            return response()->json(['error' => 'You can only edit your own books.'], 403);
        }

        $checkId = $this->postRepo->find($id);
        if(!$checkId) {

            return response()->json(['error'=>"{$id} is not exist"], 400);
        }

        $data = array();

        $data['title'] = $request->get('title');
        $data['category_id'] = $request->get('category');
        $data['content']=$request->get('content');
        $data['user_id']= $request->user()->id;

        $result = $this->postRepo->update($data, $id);



    }

    public function edit (Request $request, $id) {

    }


    public function delete($id) {
        $this->postRepo->delete($id);
        return response()->json([],204);
    }
}
