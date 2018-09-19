<?php

namespace App\Http\Controllers\PdfGenerate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Services\Pdf\Generator;
use Validator;


class PdfController extends Controller
{
    private $pdfGenerator;

	public function __construct(Generator $pdfGenerator)
    {
        $this->middleware('auth');
        $this->pdfGenerator = $pdfGenerator;
        
    }

    public function index () {
    	return view ('pdf.pdfview');
    }
    public function store(Request $request)
    {
        if($request->has('url') && $request->has('type')){
        	$validator = Validator::make($request->all(),[
        		'url' => 'bail|required|url',
                'type'=>'bail|required',
    		]);
            if($validator->fails()) {
                return redirect()->route('generator')->withErrors($validator)->withInput();
            }
            else {
                $url = $request->input('url');
                $type = $request->get('type');
                $outputPath;
                if($type == 'pdf') {
                    $outputPath = public_path("uploads/files/pdfFile.pdf");
                }
                else {
                    $outputPath = public_path("uploads/files/imgFile.jpg");
                }

                if(!file_exists(public_path('uploads/files'))) {
                    mkdir(public_path('uploads/files'), 0777, true);
                }
                //Delete file if exist
                if(file_exists($outputPath)){
                    unlink($outputPath);
                }

                //execute print html to pdf or jpg
                $this->pdfGenerator->setUrl($url)
                    ->setOutputPath($outputPath)
                    ->setType($type)
                    ->execute();
            }
        }
        return view('pdf.pdfview', compact('type'));
    }
}
