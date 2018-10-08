<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 30/09/2018
 * Time: 22:37
 */

namespace App\Services\Post;

use App\Repositories\Contracts\PostRepositoryInterface;
use Validator;
use App\Http\Resources\PostResource;

class UpdatePostService
{
    private $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }


    public function execute($request, $id) {

        //get the post by id
        $post = $this->postRepo->find($id);

        //if not exsit the post
        if(!$post) {
            return response()->json(['error' => 'The post is not exsit'], 403);
        }

        //get user id by the post
        $user_id = $post->user_id;

        //check the post is user create
        if ($request->user()->id !== $user_id) {
            return response()->json(['error' => 'You can only edit your own posts.'], 403);
        }

        //check the post is exist
        $checkId = $this->postRepo->find($id);
        if(!$checkId) {

            return response()->json(['error'=>"{$id} is not exist"], 400);
        }

        //validate data of post
        $validator = Validator::make($request->all(),[
            'title'=>'bail|required|max:100',
            'category'=>'bail|required|numeric',
            'content'=>'bail|required'
        ]);

        //validate error
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()],401);
        }

        //update in database
        try {

            $data = array();
            $data['title'] = $request->get('title');
            $data['content']=$request->get('content');
            $data['user_id']= $request->user()->id;
            $data['category_id'] = $request->get('category');
            $result = $this->postRepo->update($data, $id);
            if(!$result) {
                return response()->json(['error'=>'Creating is fail'], 500);
            }
            else {

                return response()->json(["message"=>"Update successful"],200);
            }
        }
        catch (Exception $e) {

            return response()->json($e);
        }
    }
}