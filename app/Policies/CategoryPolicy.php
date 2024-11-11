<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function create(User $user)
    {
        return $user->role === 'super admin';
    }

    public function update(User $user, Category $category)
    {
        return $user->role === 'super admin';
    }

    public function delete(User $user, Category $category)
    {
        return $user->role === 'super admin';
    }
}
