<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = ['slug', 'name'];

    protected $hidden = [];

    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_permissions', 'role_id', 'permission_id');
    }
}
