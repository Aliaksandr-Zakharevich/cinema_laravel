<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountService
{
    public function updateAccount(array $data): ?User
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user) {
            $prepareData = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];

            $user->update($prepareData);
        }

        return $user;
    }
}
