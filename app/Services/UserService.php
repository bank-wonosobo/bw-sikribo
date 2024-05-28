<?php

namespace App\Services;

use App\Http\Requests\Users\UserAddRequest;
use App\Http\Requests\Users\UserChangePasswordRequest;
use App\Http\Requests\Users\UserCreatePasswordRequest;
use App\Http\Requests\Users\UserUpdateRequest;

interface UserService
{
    function add(UserAddRequest $request);
    function createPassword(UserCreatePasswordRequest $request, string $id);
    function generatePassword(string $id);
    function changePassword(string $id, UserChangePasswordRequest $request);
    function update(UserUpdateRequest $request, $id);
    function destroy($id);

}
