<?php

namespace App\Http\Controllers\Categories;


use App\Services\ServiceFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Validator;
use Cache;
use App\Services\Factory\bak;

class CategoryController extends Controller
{

    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo) {
        $this->middleware('auth');
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index () {
        $category = $this->categoryRepo->all()->toArray();

        //set Cache
        $expireAt = Carbon::now()->addDays(7);
        if(!Cache::has('category')) {
            $result = Cache::add('category',$category,$expireAt);
        }


        return view('categories.show', compact('category'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show form input data insert database
     */
    public function create()
    {
        return view('categories.inserting');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Insert Category in Database
     */
    public function store (Request $request) {
        if($request->has('category')) {
            $request->flashOnly('name');
            $validator = Validator::make($request->all(),[
                'category'=>'bail|required|',
            ]);
            if($validator->fails()) {
                return redirect()->route('category.create')->withErrors($validator);
            }
            else {
                $category = $request->input('category');

                //check d input already in database
                $all = $this->categoryRepo->all()->toArray();
                foreach ($all as $item) {
                    if ($category == $item['name']) {
                        return redirect()->route('category.create')
                            ->with(['status'=>'Category is exist']);
                    }
                }

                $data['name']= $category;

                $result = $this->categoryRepo->create($data);
                return redirect()->route('category.index')
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
        $category = $this->categoryRepo->find($id);
        $categoryName = $category->name;
        return view('categories.update',compact('id','categoryName'));

    }

    public function update(Request $request, $id) {


        if($request->has('category')) {
            $validator = Validator::make($request->all(),[
                'category'=>'bail|required|',
            ]);
            if($validator->fails()) {
                return redirect()->route('category.edit',['id'=>$id])->withErrors($validator);
            }
            else {

                $data['name'] = $request->category;
                $result = $this->categoryRepo->update($data, $id);

                return redirect()->route('category.index')
                    ->with(['updateResult'=>$result]);
            }

        }
        //request invaild
        else {
            return redirect()->route('category.edit')
                ->with(['status'=>'Please input Category Name']);
        }

    }

    public function delete ($id) {
        $result = service("delete_category")->execute($id);
        return redirect()->route('category.index')->with(['delResult'=>$result]);
    }

    public function detail ($id) {
        $result = $this->categoryRepo->getPostByCategoryId($id)->toArray();
        $result = $result[0]; //lay category theo id nen chi co 1 record
        return view ('categories.detail', compact('result'));

    }

/*    public function test () {
        $category = $this->categoryModel->with('users')->get()->where('id',1)->toArray();
        dd($category);
        foreach ($category ->users as $user) {
            echo "$user->pivot".'<br>';
        }
    }*/

}
