<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\UserData;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserService
{
    public function createUser(array $userData)
    {
        $password = $this->generateRandomPassword();

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($password),
        ]);
        $user->notify(new UserData($user, $password, $user->roles->pluck('name')->toArray()));
        return $user;
    }

    private function generateRandomPassword(): string
    {
        return Str::random(10);
    }
}
