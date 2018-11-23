@extends('layouts.app')
@section('content')
	<form method="POST" action="{{ route('file') }}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input style="float: left;" type="file" name="image" id="files">
		<input type="submit" name="submit" value="Upload">
		<div id="img-container"></div>
	</form>
	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	@if ($message = Session::get('message'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>	
		    <strong>{{ $message }}</strong>
		</div>
	@endif
	@if(session('status'))
	    <div class="alert alert-danger">
	        {{ session('status') }}
	    </div>
	@endif
@endsection
