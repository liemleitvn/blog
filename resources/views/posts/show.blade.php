@extends('layouts.app')

@section('content')
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
		<button class="btn btn-info">
			<a style="text-decoration: none" href="{{ route('post.create') }}">Insert</a>

		</button>
		<div style="padding-left: 0" class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<form class="input-group" action="{{ route('post.index') }}" method="get">
				<input type="text" class="form-control" name="s" id="searchPost" placeholder="Seach for..."/>
				<span class="input-group-btn">
                    <button type = "submit" class="btn btn-info">Search</button>
                    <button class="btn btn-warning" type="reset">
						<a style="text-decoration: none" href="{{route('post.index')}}">Clear</a>
					</button>
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
                    <?php $index = 1 ?>
					@foreach ($allPost as $post)
						<tr>
							<td>{{ $index }}</td>
							<td>{{ $post['title'] }}</td>
							<td>{{ $post['content'] }}</td>
							<td>{{ $post['user'] }}</td>
							<td>{{ $post['category'] }}</td>
							<td>
								<button class="btn btn-warning">
									<a style="text-decoration: none" href="{{ url('post/update/'.$post['id']) }}">Edit</a>
								</button>
								<button class="btn btn-danger">
									<a style="text-decoration: none" href="{{ url('post/delete/'.$post['id']) }}">Delete</a>
								</button>
							</td>
						</tr>
                        <?php $index++ ?>
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