<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Store a new user.
     */
    public static function store(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    /**
     * Update the specified user
     */
    public static function update(User $user, array $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->fill($data);
        $user->save();

        return true;
    }

    /**
     * Delete the specified user
     */
    public static function delete(user $user): bool
    {
        return $user->delete();
    }
}
