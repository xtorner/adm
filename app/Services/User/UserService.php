<?php

namespace App\Services\User;

use App\Http\Requests\User\UserRequest;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;

class UserService
{
    protected $user;
    protected $role;

    public function __construct(
        UserRepository $user,
        RoleRepository $role
    ){
        $this->user = $user;
        $this->role = $role;
    }

    public function list()
    {
        return $this->user->all();
    }

    public function create(UserRequest $request)
    {
        $attributes = $request->all();

        if (isset($attributes['password'])) {
            $attributes['password'] = \Hash::make($attributes['password']);
        }

        if (!$request->has('active')) {
            $attributes['active'] = 0;
        }

        return $this->user->create($attributes);
    }

    public function read($id)
    {
        return $this->user->find($id);
    }

    public function update(UserRequest $request, $id)
    {
        $attributes = $request->all();

        if (isset($attributes['password'])) {
            $attributes['password'] = \Hash::make($attributes['password']);
        } else {
            unset($attributes['password']);
        }

        if (!$request->has('active')) {
            $attributes['active'] = 0;
        }

        return $this->user->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

    public function roles()
    {
        return $this->role->all();
    }
}
