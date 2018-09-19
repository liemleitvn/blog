

@extends('layouts.app')

@section('content')
    <div>
        <h2>Category: {{ $result['name'] }}</h2>
        <p>Date create: {{ $result['created_at'] }}</p>
        <br>
        <p><strong>{{ $result['name'] }} Posts</strong></p>
        <table>
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Content</th>
                <th>Date create</th>
                <th>Last date update</th>
            </tr>
            @foreach($result['posts'] as $post)
                <tr>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['user'] }}</td>
                    <td>{{ $post['content'] }}</td>
                    <td>{{ $post['created_at'] }}</td>
                    <td>{{ $post['updated_at'] }}</td>
                </tr>
            @endforeach
        </table>
        <button><a href="{{ url('category') }}" style="text-decoration: none">Back</a></button>
    </div>
@endsection