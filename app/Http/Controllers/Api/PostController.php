<?php

namespace App\Http\Controllers\Api;

use App\Http\Middleware\AuthJWT;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use JWTAuth;
use Exception;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    private $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function index() {

    }

    public function show ($id) {

    }

    public function store(Request $request) {
        try {
            $data = array();

                $data['title'] = $request->get('title');
                $data['category_id'] = $request->get('category');
                $data['content']=$request->get('content');
                $data['user_id']= $request->user()->id;
                $result = $this->postRepo->create($data);
                if(!$result) {
                    return response()->json(['Creating is fail'], 405);
                }
                else {
                    return response()->json([new PostResource($result)],200);
                }
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    }

    public function update(Request $request, $id) {

    }

    public function edit (Request $request, $id) {

    }


    public function delete($id) {

    }
}
