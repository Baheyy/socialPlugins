<?php
/**
 * Created by PhpStorm.
 * User: baheyy
 * Date: 6/3/15
 * Time: 4:05 PM
 */
namespace App\Http\Controllers\Auth;

interface AuthenticateUserListener
{
    public function userHasLoggedIn($user);
}