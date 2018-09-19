<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ResizeImage;
use Validator;
use App\Models\Image;

class ImageController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('uploads.image');
    }

    public function store(Request $request) {
        if ($request->hasFile('image')) {

            $validator = Validator::make($request->all(),[
        		'image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    		]);

    		if($validator->fails()) {
        		return redirect()->route('file')->withErrors($validator)->withInput();
        	}
        	else {
        	    //lay file tu request
		        $image = $request->file('image');

		        //set ten file
		        $filename = md5(time()) . '.' . $image->getClientOriginalExtension();

		        //vi tri dat file upload
		        $destinationPath = public_path('/uploads/images');

		        //kiem tra folder chua ton tai thi tao folder
		        if(!file_exists($destinationPath)) {
		        	mkdir($destinationPath, 0777, true);
		        }

		        //move file tu thu muc tam vao thu muc upload
		        $image->move($destinationPath, $filename);
		 
		        // defer the processing of the image thumbnails
                //Dua thong tin vao xu ly ben trong job
		        ResizeImage::dispatch($destinationPath, $filename, 300, 300);
		 
		        return redirect()->route('file')->with(['message'=>'Image uploaded successfully!']);
        	}
        }
        else {
        	return redirect()->route('file')-> with(['status'=>'Please choose image before Upload']);
        }
    }
}

