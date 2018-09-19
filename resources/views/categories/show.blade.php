@extends('layouts.app')

@section('content')
	<div style="margin: 20px">
		<button><a style="text-decoration: none" href="{{ route('category.create') }}">Insert</a></button>
	</div>
	{{--isset($category) Su dung voi du lieu truyen la compact --}}
	@if(isset($category))
		<?php $index = 1; ?>
		<table style="margin: 20px">
			<tr >
				<th>No</th>
				<th>Name</th>
			</tr>
			@foreach ($category as $cate)
			<tr>
				<td>{{ $index }}</td>
				<td>{{ $cate['name'] }}</td>
				{{--show post in category--}}
				<td><a href="{{ url('category/detail/'.$cate['id']) }}">Detail</a></td>
				{{--update category--}}
				<td><a href="{{ url('category/update/'.$cate['id']) }}" >Update</a></td>
				{{--Delete category--}}
				<td><a href="{{ url('category/delete/'.$cate['id']) }}" >Delete</a></td>
			</tr>
			<?php $index++ ?>
			@endforeach
		</table>
	@else
		<p>Not isset category</p>
	@endif

	{{--Result insert category--}}
	@if($insertResult = Session::get('insertResult'))
		@if($insertResult == true)
			<p class="alert alert-success alert-block">Insert successfull</p>
		@else
			<p class="alert alert-danger">Insert fail!</p>
		@endif
	@endif

	{{--Result update--}}
	@if($updateResult = Session::get('updateResult'))
		@if($updateResult == true)
			<p class="alert alert-success alert-block">Update successfull</p>
		@else
			<p class="alert alert-danger">Update fail!</p>
		@endif
	@endif

	{{--$result = Session::get('result') su dung voi du lieu truyen la with o controller, route--}}
	{{--Result delete category--}}
	@if($delResult = Session::get('delResult'))
		@if($delResult == true)
			<p class="alert alert-success alert-block">Delete successfull. </p>
		@else
			<p class="alert alert-danger">Delete fail!</p>
		@endif
	@endif
@endsection