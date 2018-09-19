
@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('category.create') }}">
        {{ csrf_field() }}
        <label for="category">Category Name</label>
        <input type="text" name="category" id="category" value="{{ old('category') }}">
        <input type="submit" value="Add">
        <button><a style="text-decoration: none" href="{{ route('category.index') }}">Cancel</a></button>
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
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if($message = Session::get('status'))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif
@endsection