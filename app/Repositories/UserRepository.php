<?php
namespace App\Repositories;

use App\User;

class UserRepository {

    /**
     * @param $userData
     * @return static
     * Logs in a Github User
     */

    public function findByUsernameOrCreate($userData)
    {
        return User::firstOrCreate([
            'username'  =>  $userData->nickname,
            'email'     =>  $userData->email,
            'avatar'    =>  $userData->avatar,
        ]);
    }

    /**
     * @param $userData
     * @return static
     * Logs in a Facebook User
     */
    public function findByNameOrCreate($userData)
    {
        return User::firstOrCreate([
            'username'  =>  $userData->name,
            'email'     =>  $userData->email,
            'avatar'    =>  $userData->avatar,
        ]);
    }

} 