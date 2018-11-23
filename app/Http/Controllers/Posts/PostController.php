<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Auth;
use Validator;

class PostController extends Controller
{

    private $postRepo;
    private $categoryRepo;

    public function __construct(PostRepositoryInterface $postRepo,
                                CategoryRepositoryInterface $categoryRepo) {
        $this->middleware('auth');
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = \request('s', "");

        $allPost = service('get_post')->execute($keyword, $page = 1)->toArray();
        return view('posts.show', compact('allPost'));

        // posts join categoties where content = Test
        // $this->postModel->with('category')->where('content','Test')->get()->toArray();
        // dd($posts);

        // select * from ports where id = 2
    }

    public function showById($id) {
        dd($id);
    }

    public function create() {
        $category = $this->categoryRepo->all();
        return view('posts.inserting', compact('category'));
    }

    public function store (Request $request) {
        if($request->has('title') && $request->has('category') && $request->has('content')) {
            $request->flashOnly('title','content');
            $validator = Validator::make($request->all(),[
                'title'=>'bail|required|max:100',
                'category'=>'bail|required|numeric',
                'content'=>'bail|required'
            ]);
            if($validator->fails()) {
                return redirect()->route('post.create')->withErrors($validator);
            }
            else {
                $data['title'] = $request->title;
                $data['category_id'] = $request->category;
                $data['content'] = $request->get('content');
                $data['user_id'] = Auth::user()->id;

                $result = $this->postRepo->create($data);
                return redirect()->route('post.index')
                    ->with(['insertResult'=>$result]);

            }
        }
        //request invaild
        else {
            return redirect()->route('category.create')
                ->with(['status'=>'Please input Category Name']);
        }
    }

    public function edit($id) {
        $post = $this->postRepo->find($id);
        $category = $this->categoryRepo->all();
        return view('posts.update', compact('id', 'post', 'category'));
    }

    public function update (Request $request, $id) {

        if($request->has('title') && $request->has('category') && $request->has('content')) {
            $validator = Validator::make($request->all(),[
                'title'=>'bail|required|max:100',
                'category'=>'bail|required|numeric',
                'content'=>'bail|required'
            ]);
            if($validator->fails()) {
                return redirect()->route('post.edit',['id'=>$id])->withErrors($validator);
            }

            $post = $this->postRepo->find($id);

            $user_id = $post->user_id;

            if($user_id !== Auth::user()->id) {
                return redirect()->route('post.edit',['id'=>$id])->withErrors(['errors'=>'You can only edit own  your posts.']);
            }

            $data['title'] = $request->title;
            $data['category_id'] = $request->category;
            $data['content'] = $request->get('content');
            $data['user_id'] = Auth::user()->id;

            $result = $this->postRepo->update($data, $id);

            return redirect()->route('post.index')
                ->with(['updateResult'=>$result]);


        }
        //request invaild
        else {
            return redirect()->route('post.edit')
                ->with(['status'=>'Sorry Error system!']);
        }
    }

    public function delete ($id) {

        $post = $this->postRepo->find($id);

        $user_id = $post->user_id;

        if($user_id !== Auth::user()->id) {
            return redirect()->route('post.edit',['id'=>$id])->withErrors(['errors'=>'You can only edit own  your posts.']);
        }

        $result = $this->postRepo->delete($id);
        return redirect()->route('post.index')->with(['delResult'=>$result]);
    }

    public function search () {

        $keyword = $_GET['s'];

       $result = $this->postRepo->getPostByTitle($keyword, 0, 100);

        return response()->json($result);
    }
}
