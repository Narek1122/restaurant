<?php

namespace App\Repositories;


use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRepository
{

    public function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $role = Role::where('name','User')->first();

        $user->assignRole([$role->id]);

        return $user;
    }

}
