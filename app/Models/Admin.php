<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // Many-to-Many relationship with Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }

    // Check if admin has a specific role
    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }
}
