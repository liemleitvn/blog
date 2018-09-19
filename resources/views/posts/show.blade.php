@extends('layouts.app')

@section('content')
	<div style="margin: 20px">
		<button><a style="text-decoration: none" href="{{ route('post.create') }}">Insert</a></button>
	</div>
	@if(isset($allPost))
		<table style="margin: 20px">
			<tr >
				<th>ID</th>
				<th>Title</th>
				<th>Content</th>
				<th>User</th>
				<th>Category</th>
			</tr>
			<?php $index = 1 ?>
			@foreach ($allPost as $post)
			<tr>
				<td>{{ $index }}</td>
				<td>{{ $post['title'] }}</td>
				<td>{{ $post['content'] }}</td>
				<td>{{ $post['user'] }}</td>
				<td>{{ $post['category'] }}</td>
				<td><a href="{{ url('post/update/'.$post['id']) }}">Update</a></td>
				<td><a href="{{ url('post/delete/'.$post['id']) }}">Delete</a></td>
			</tr>
				<?php $index++ ?>
			@endforeach
		</table>
	@else
		<p>Not isset allPost</p>
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