@extends('layouts.app')
@section('content')
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 offset-3">
        <div class="container">
            <div>
                <p>
                    <span style="font-size: 25px">Role Matrix</span>
                    Roles that are on each permission
                </p>
            </div>
            <form method="post" action="{{route('admin.roles.update', ['id'=>$role->id])}}">
                {{ csrf_field() }}
                <div class="form-edit-role-name">
                    <label>Role Name</label>
                    <input name="roleName" type="text" value="{{ $role->name }}">
                </div>
                <table class="table table-striped table-bordered container text-center">
                    <thead>
                    <tr>
                        <th style="width: 10%">#</th>
                        <th style="width: 60%">Permission</th>
                        <th>{{ $role->name }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $key=>$permission)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$permission->name}}</td>
                            <td>
                                <input
                                        type="checkbox"
                                        {{ in_array($permission->id, $permission_id)? 'checked':'' }}
                                        name="user-role-{{ $permission->id }}"
                                        value="{{ $permission->id }}"
                                >
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="container">
                    <button class="btn btn-default">
                        <a style="text-decoration: none; display: block" href="{{ url('admin/roles') }}">Back</a>
                    </button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>
@endsection