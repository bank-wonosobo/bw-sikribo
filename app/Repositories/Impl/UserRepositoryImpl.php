<?php

namespace App\Repositories\Impl;

use App\Models\User;
use App\Repositories\UserRepository;

class UserRepositoryImpl implements UserRepository
{

    function getAll()
    {
        return User::orderBy('created_at', 'DESC')
            ->get();
    }

    function create(array $userDetail, array $roles)
    {
        $user = new User($userDetail);
        $user->save();
        $user->roles()->attach($roles);
        $user->save();
        return $user;
    }

    function update(string $userId, array $userDetail, $roles)
    {
        $user = User::find($userId);
        $user->name = $userDetail['name'];
        $user->email = $userDetail['email'];
        $user->roles()->sync($roles);
        $user->save();
        return $user;
    }

    function delete(string $userId)
    {
        $user = User::find($userId);
        $user->roles()->detach();
        return $user->delete();
    }

    function updatePassword(string $id, string $password)
    {
        $user = User::find($id);
        $user->password = $password;
        $user->save();

        return $user;
    }
}
