@extends('layouts.app')

@section('content')
	@if(Session::has('message'))
		<p class="alert alert-danger container {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
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
	<div class="container">
		<div style="padding-left: 0; float: right">
			<form class="input-group" action="{{ route('post.index') }}" method="get">
				<input style = "border: none" type="text" class="form-control" name="s" id="searchPost" placeholder="Seach for..."/>
				<span class="input-group-btn">
                    <button type = "submit" class="btn btn-info">Search</button>
					<a class="btn btn-warning" style="text-decoration: none" href="{{route('post.index')}}">Clear</a>
					<a class="btn btn-info" style="float:right; margin-left: 5px; text-decoration: none" href="{{ route('post.create') }}">Insert</a>
				</span>
			</form>
		</div>
	</div>
	@if(isset($allPost))
		<div class="container">
			<div class="panel panel-success">
				<div class="panel-heading">Posts List</div>
				<table class="table table-hover">
					<tr >
						<th width="10%">#</th>
						<th width="15%">Title</th>
						<th>Content</th>
						<th width="10%">User</th>
						<th width="10%">Category</th>
						<td width="15%">Action</td>
					</tr>
					@foreach ($allPost as $key=>$post)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $post['title'] }}</td>
							<td>{{ $post['content'] }}</td>
							<td>{{ $post['user'] }}</td>
							<td>{{ $post['category'] }}</td>
							<td>
								<a  class="btn btn-warning" style="text-decoration: none" href="{{ url('post/update/'.$post['id']) }}">Edit</a>
								<a class="btn btn-danger" style="text-decoration: none" href="{{ url('post/delete/'.$post['id']) }}">Delete</a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
	@else
		<table>
			<tr>
				<td class="text-center">0</td>
				<td>Title</td>
				<td>No Content</td>
				<td class="text-center">Default</td>
				<td class="text-center">Default</td>
				<td></td>
			</tr>;
		</table>
	@endif
@endsection