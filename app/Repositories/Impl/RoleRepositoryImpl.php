<?php

namespace App\Repositories\Impl;

use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleRepositoryImpl implements RoleRepository {
    
    function getAllRoles()
    {
        return Role::all();
    }
    
    function createRole(array $roleDetail)
    {
        return Role::create($roleDetail);
    }
    
    function deleteRole(int $roleId): void
    {
        Role::destroy($roleId);
    }
        
}