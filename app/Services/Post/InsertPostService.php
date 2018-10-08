<?php
/**
 * Created by PhpStorm.
 * User: liemleitvn
 * Date: 28/09/2018
 * Time: 23:34
 */

namespace App\Services\Post;

use App\Repositories\Contracts\PostRepositoryInterface;
use Validator;
use App\Http\Resources\PostResource;

class InsertPostService
{
    private $data;
    private $postRepo;
    public function __construct(PostRepositoryInterface $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function execute($request) {
        $validator = Validator::make($request->all(),[
            'title'=>'bail|required|max:100',
            'category'=>'bail|required|numeric',
            'content'=>'bail|required'
        ]);

        //validate error
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()->first()],401);
        }

        //insert in database
        try {
                $data = array();

                $data['title'] = $request->get('title');
                $data['category_id'] = $request->get('category');
                $data['content']=$request->get('content');
                $data['user_id']= $request->user()->id;
                $result = $this->postRepo->create($data);
                if(!$result) {
                    return response()->json(['error'=>'Creating is fail'], 500);
                }
                else {
                    return response()->json([new PostResource($result)],201);
                }
        }
        catch (Exception $e) {
            return response()->json($e);
        }
    }

}