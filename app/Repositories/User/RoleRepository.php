<?php
namespace App\Repositories\User;

use App\UserRole;

class RoleRepository
{
    protected $role;

    public function __construct(UserRole $role)
    {
        $this->role = $role;
    }

    public function create($attributes)
    {
        return $this->role::create($attributes);
    }

    public function all()
    {
        return $this->role::all();
    }

    public function find($id)
    {
        return $this->role::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->role::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->role::find($id)->delete();
    }
}