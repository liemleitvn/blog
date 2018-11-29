<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Auth;
use Illuminate\Support\Facades\Session;
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

                $slug = str_replace(' ','-', $request->title);
                $posts = $this->postRepo->all();

                //check exist slug in table posts
                foreach ($posts as $key=>$post) {
                    if($post->slug == $slug) {
                        $slug = str_replace(' ','-', $request->title).'-'.($key+1);
                    }
                }

                $data['title'] = $request->title;
                $data['category_id'] = $request->category;
                $data['content'] = $request->get('content');
                $data['user_id'] = Auth::user()->id;
                $data['slug'] = $slug;

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

        if(Auth::user()->cant('posts.update', $post)) {
            Session::flash('message', 'You can only edit own  your posts.');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('post.index',['id'=>$id]);
        }
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

            $data = [];

            //if not change title, update category_id and content
            //else change all
            $post = $this->postRepo->find($id);
            if($post->title ===$request->title) {
                $data['category_id'] = $request->category;
                $data['content'] = $request->get('content');
            }
            else {
                $slug = str_replace(' ','-', $request->title);
                $posts = $this->postRepo->all();

                //check exist slug in table posts
                foreach ($posts as $key=>$post) {
                    if($post->slug == $slug) {
                        $slug = str_replace(' ','-', $request->title).'-'.($key+1);
                    }
                }

                $data['title'] = $request->title;
                $data['category_id'] = $request->category;
                $data['content'] = $request->get('content');
                $data['slug'] = $slug;
            }

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

        if(Auth::user()->cant('posts.delete', $post)) {
            Session::flash('message', 'You can only delete own  your posts.');
            Session::flash('alert-class', 'alert-danger');
            return redirect()->route('post.index',['id'=>$id]);
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
