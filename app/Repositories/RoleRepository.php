<?php

namespace App\Repositories;

interface RoleRepository {
    function getAllRoles(); 
    function createRole(array $roleDetail);
    function deleteRole(int $roleId): void;
}