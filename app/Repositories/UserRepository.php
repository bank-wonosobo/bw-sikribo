<?php

namespace App\Repositories;

interface UserRepository
{
    function getAll();
    function create(array $userDetail, array $roles);
    function update(string $userId, array $userDetail, $roles);
    function delete(string $userId);
    function updatePassword(string $id, string $password);
}
