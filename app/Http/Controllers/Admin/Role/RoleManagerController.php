<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Requests\RoleRequest;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RoleManagerController extends Controller
{

    private $role;
    private $permission;

    public function __construct(RoleRepositoryInterface $roleRepo, PermissionRepositoryInterface $permissionRepo)
    {
        $this->role = $roleRepo;
        $this->permission = $permissionRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->role->all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $request->flashOnly('name', 'description');
        $data = $request->only('name', 'description');
        $data['slug'] = str_replace(' ', '-', $request->name);

        $this->role->create($data);

        Session::flash('message', 'The role has been inserted in table roles');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->role->find($id);
        $permissions = $this->permission->all();

        $permission_id = [];

        foreach ($role->permissions as $permission) {
            $permission_id[] = $permission->id;
        }

        return view('admin.role.edit', compact('role', 'permission_id', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = $this->role->find($id);

        if($role->name != $request->roleName) {
            $data['name'] = $request->roleName;
            $this->role->update($data, $id);
        }

        //Delete all record in roles_permissions of $role
        $role->permissions()->detach();

        //Insert role_id, permission_id for roles_permissons table
        foreach ($request->all() as $key=>$value) {
            if(strpos($key,"user-role") === 0) {
                $role->permissions()->attach($value);
            }
        }

        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->role->delete($id);

        if($result) {
            Session::flash('message', 'The role has been deleted in table roles');
            Session::flash('alert-class', 'alert-success');
        }
        else {
            Session::flash('message', 'Fail deleting');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect()->route('admin.roles.index');
    }
}
