<?php

namespace App\Services\Impl;

use App\Exceptions\UserPasswordNotSame;
use App\Http\Requests\Users\UserAddRequest;
use App\Http\Requests\Users\UserChangePasswordRequest;
use App\Http\Requests\Users\UserCreatePasswordRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\Slik;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Traits\ManageFile;
use Illuminate\Support\Facades\Hash;

class UserServiceImpl implements UserService
{

    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function add(UserAddRequest $request)
    {

        $password = $this->generataRandomString(4);

        $passwordHash = Hash::make($password);

        $detailUser = $request->only([
            'name', 'email'
        ]);

        $detailUser['password'] = $passwordHash;

        $roles = $request->input('roles');

        $user = $this->userRepository->create($detailUser, $roles);
        $user->password = $password;

        return $user;
    }



    function createPassword(UserCreatePasswordRequest $request, string $id)
    {
        $password = $request->input('password');
        $passwordHash = Hash::make($password);
        $user = $this->userRepository->updatePassword($id, $passwordHash);
        return $user;
    }


    function generatePassword(string $id)
    {
        $password = $this->generataRandomString(8);
        $passwordHash = Hash::make($password);
        $user = $this->userRepository->updatePassword($id, $passwordHash);
        $user->password = $password;
        return $user;
    }

    function changePassword(string $id, UserChangePasswordRequest $request)
    {
        $oldPassword = $request->input('old_password');

        $user = User::find($id);

        $password = $user->password;

        if (!Hash::check($oldPassword, $password)) {
            throw new UserPasswordNotSame('password lama salah');
        }

        $newPassword = $request->input('new_password');

        $newPasswordHash = Hash::make($newPassword);

        $user = $this->userRepository->updatePassword($id, $newPasswordHash);
        return $user;
    }


    function generataRandomString($size)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $size; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    function update(UserUpdateRequest $request, $id)
    {
        $detailUser = $request->only([
            'name', 'email'
        ]);


        $roles = $request->input('roles');

        $user = $this->userRepository->update($id, $detailUser, $roles);

        return $user;
    }

    public function destroy($id)
    {
        // TODO
    }
}
