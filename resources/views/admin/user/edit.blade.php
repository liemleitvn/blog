@extends('layouts.app')
@section('content')
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 offset-3">
        <div class="container">

            {{--Start alert result insert, update, delete--}}
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            {{--End alert result insert, update, delete--}}

            @if(isset($error))
                <h4>{{ $error }}</h4>
            @else
                <form method="post" action="{{ route('admin.users.update', ['as'=>$user->id]) }}">
                    {{ csrf_field() }}
                    <h4>Here you can see {{$user->name}} account's detail</h4>
                    <table class="container table table-hover">
                        @php
                            $roles_id = [];
                        @endphp
                        <tr>
                            <th style="width: 20%">ID:</th>
                            <td style="width: 70%;">{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                @foreach($user->roles as $role)
                                    @php
                                        $roles_id[] = $role->id
                                    @endphp
                                    <span class=" badge badge-success role-in-user"
                                          data-id="{{ $user->id }}-{{ $role->id }}">{{ $role->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Email verified:</th>
                            <td>{{ $user->email_verified_at }}</td>
                        </tr>
                        <tr>
                            <th>Member since:</th>
                            <td>{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Last Update:</th>
                            <td>{{ $user->updated_at}}</td>
                        </tr>
                        <tr>
                            <th>Last Login:</th>
                            <td>{{ $user->last_login_at }}</td>
                        </tr>
                        <tr>
                            <th>Last Login Ip:</th>
                            <td>{{ $user->last_login_ip }}</td>
                        </tr>
                        <tr>
                            <th>Add role:</th>
                            <td>
                                <select name="role" class="custom-select">
                                    <option value={{ -1 }}>Select</option>
                                    @foreach($roles as $key=>$role)
                                        @if(in_array($role->id, $roles_id))
                                            @continue
                                        @endif
                                        <option value="{{$role->id}}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br>
                    <a
                            class="btn btn-dark action-back"
                            style="text-decoration: none"
                            href="{{ route('admin.users.index') }}"
                    >Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            @endif
        </div>
    </div>
@endsection