
@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('category.edit', ['id' => $id]) }}">
        {{ csrf_field() }}
        <table>
            <tr>
                <td><label for="category">Category Name</label></td>
                <td><input type="text" name="category" id="category" value="{{ $categoryName }}"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Update">
                <button><a style="text-decoration: none" href="{{ route('category.index') }}">Cancel</a></button>
                </td>
            </tr>
        </table>
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