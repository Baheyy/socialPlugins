<?php
namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Contracts\Auth\Guard;
use App\Repositories\UserRepository;

class AuthenticateUser {

    public function __construct(UserRepository $users, Socialite $socialite, Guard $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    public function execute($hasCode, AuthenticateUserListener $listener)
    {
        if(!$hasCode)
        {
            return $this->getAuthorizationFirst();
        }

        $user = $this->users->findByUsernameOrCreate($this->getGithubUser());

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getGithubUser()
    {
        return $user = $this->socialite->driver('github')->user();
    }

    private function getAuthorizationFirst()
    {
        return $this->socialite->driver('github')->redirect();
    }

    public function fbexecute($hasCode, AuthenticateUserListener $listener)
    {
        if(!$hasCode) {return $this->getFacebookAuthorizationFirst();}

        $user = $this->users->findByNameOrCreate($this->getFacebookUser());

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    public function getFacebookAuthorizationFirst()
    {
        return $this->socialite->driver('facebook')->redirect();
    }

    private function getFacebookUser()
    {
        return $user = $this->socialite->driver('facebook')->user();
    }

} 