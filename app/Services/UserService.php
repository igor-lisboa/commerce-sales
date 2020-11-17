<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    /**
     * 
     * Init the class and inform the model
     * 
     * @param  \App\Models\User  $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * 
     * Try make login using the credentials informed and if isn't successful, send back to previous route
     * 
     * @param  string  $email
     * @param  string  $password
     * @param  boolean  $remember
     * @return redirect
     */
    public function auth($email, $password, $remember = false)
    {
        // try make the login
        if (!Auth::attempt(["email" => $email, "password" => $password], $remember)) {
            // if the auth fail send to last route and pass msg_invalid_credentials as error
            return redirect()->back()->withErrors(__("msg_invalid_credentials"))->withInput();
        }

        // if the auth is ok send to home
        return redirect()->route('home');
    }

    /**
     * 
     * Logout user
     * @return redirect
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * 
     * Try make login using the credentials informed and if isn't successful, send back to previous route
     * 
     * @param  string  $email
     * @param  string  $email
     * @param  string  $password
     * @return redirect
     */
    public function register($name, $email, $password)
    {
        // put the variables inside one array
        $data = compact("name", "email", "password");

        // make a hash of the password
        $data['password'] = Hash::make($data['password']);

        // create a new user with the data informed
        $user = User::create($data);

        // set the new user as logged user
        Auth::login($user);

        // redirect to home
        return redirect()->route('home');
    }
}
