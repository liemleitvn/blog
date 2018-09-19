<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	protected $guard = 'admin';

	public function __construct()
    {
      	// $this->middleware('admin');
    }
	
    public function index() {
    	return view('admin.dashboard.index');
    }
}
