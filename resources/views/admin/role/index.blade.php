@extends('layouts.app')
@section('content')
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 offset-1">
        <div class="container">
            {{--Show error if error validate--}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--end show error validate--}}

            {{--Start alert result insert, update, delete--}}
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            {{--End alert result insert, update, delete--}}

            {{--Start show result create, update, delete role--}}
            @if($resultInserting = Session::get('resultInserting'))
                <p class="alert alert-success alert-block">Insert successful role {{ $resultInserting->role }}</p>
            @endif
            {{--End show result--}}
        </div>

        {{--Button Insert role--}}
        <div class="container">
            <button
                    style="float: right"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#modal-insert-role"
            >
                Add Role
            </button>

        </div>
        {{--End button insert role--}}

        {{--Modal insert role--}}
        <div class="modal fade" id="modal-insert-role" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inserting Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('admin.roles.insert') }}">
                        {{ csrf_field() }}
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <label data-error="wrong" data-success="right" for="name">Role name</label>
                                <input type="text" id="name" name="name" class="form-control validate" placeholder="Entry role" value="{{ old('name') }}">
                            </div>

                            <div class="md-form mb-4">
                                <label data-error="wrong" data-success="right" for="description">Description</label>
                                <input type="text" class="form-control validate" id="description" placeholder="Describe role" name="description" value="{{ old('description') }}">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="insert-role">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{--End modal insert role--}}

        {{--Show Roles--}}
        @if(isset($roles))
            <div class="container">
                <div class="panel panel-success">
                    <div class="panel-heading">Posts List</div>
                    <table class="table table-hover">
                        <tr >
                            <th width="5%">#</th>
                            <th width="15%">Name</th>
                            <th width="30%">Description</th>
                            <th>Permission</th>
                            <th class="text-center" scope="col" style="width: 7%">Edit</th>
                            <th class="text-center" scope="col" style="width: 7%">Delete</th>
                        </tr>
                        <?php $index = 1 ?>
                        @foreach ($roles as $role)
                            <tr>
                                <td scope="row">{{ $index }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    @foreach($role->permissions as $key=>$permission)
                                        <span class="badge badge-success">{{ $permission->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center" scope="col">
                                    <a
                                            data-toggle="tooltip" data-placement="top" title="Edit role '{{ $role->name }}'"
                                            href="{{ route('admin.roles.edit', ['as'=>$role->id]) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                                <td class="text-center" scope="col">
                                    <a
                                            data-toggle="tooltip" data-placement="top" title="Delete role '{{ $role->name }}'"
                                            href="{{ route('admin.roles.delete', ['id'=>$role->id]) }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
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
        {{--End show roles--}}

    </div>
@endsection