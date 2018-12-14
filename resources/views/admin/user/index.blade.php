@extends('layouts.app')
@section('content')

    {{--Start form show user--}}
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="container">
            <table class="table table-hover ">
                <thead class="thead-light">
                <tr>
                    <th scope="col" style="width: 10%">#</th>
                    <th scope="col" style="width: 15%">Name</th>
                    <th scope="col" style="width: 30%">Email</th>
                    <th scope="col" style="width: 15%">Role</th>
                    <th class="text-center" scope="col" style="width: 15%">Edit</th>
                    <th class="text-center" scope="col" style="width: 15%">Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                    @if($user->email == 'admin@authorization.local')
                        @continue
                    @endif
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge badge-success">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="action-edit text-center" scope="col">
                            <a
                                    data-toggle="tooltip" data-placement="top" title="Edit user"
                                    href="{{ route('admin.users.edit', ['as'=>$user->id]) }}">
                                edit<i class="fa fa-pencil"></i>
                            </a>
                        </td>
                        <td class="action-delete text-center" scope="col">
                            <a
                                    data-toggle="tooltip" data-placement="top" title="Delete user"
                                    href="{{ route('admin.users.delete', ['as'=>$user->id]) }}">
                                del<i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $users->links() !!}
        </div>
    </div>
    {{--End form show user--}}
@endsection