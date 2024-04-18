<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\UserData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserService
{
    public function createUser(array $userData)
    {
        $user = null;
        $password = $this->generateRandomPassword();
        DB::transaction(function () use ($userData, $password, &$user) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($password),
            ]);
            $user->roles()->attach($userData['role_id']);
            $user->notify(new UserData($user, $password, $user->roles->pluck('name')->toArray()));
        });
        return $user;
    }

    public function updateUser(User $user, array $data)
    {
        DB::transaction(function () use ($user, $data) {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password,
            ]);
            if (isset($data['role_id'])) {
                $user->roles()->sync($data['role_id']);
            }
        });
        return $user;
    }

    private function generateRandomPassword(): string
    {
        return Str::random(10);
    }
}
