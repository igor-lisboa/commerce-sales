<?php

namespace App\Services;

use App\Events\RequestPasswordChange;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
     * @return \Illuminate\Http\RedirectResponse
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * 
     * Send the email to update the password from one user
     * @param string $email
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestChangePassword($email)
    {
        // find the user
        $user = User::where('email', '=', $email)->first();

        // if user exists
        if ($user != null) {
            // update the remember token
            $user->remember_token = Str::random(10);
            $user->save();

            // call the event of RequestPasswordChange
            $eventRequestPasswordChange = new RequestPasswordChange($user);

            // Dispatch the event
            event($eventRequestPasswordChange);
        }

        // redireciona p login
        return redirect()->route('login');
    }

    /**
     * 
     * Register user and if isn't successful, send back to previous route
     * 
     * @param  string  $email
     * @param  string  $email
     * @param  string  $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register($name, $email)
    {
        // put the variables inside one array
        $data = compact("name", "email");

        // make a hash of the password
        $data['password'] = Hash::make(Str::random(10));

        // create a new user with the data informed
        User::create($data);

        // redirect to home
        return redirect()->route('user.index');
    }

    /**
     * 
     * update password of one user by remeber_token
     * 
     * @param  string  $remember_token
     * @param  array  $atributtes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword($remember_token, $atributtes)
    {
        $this->setModel(User::where('remember_token', '=', $remember_token)->firstOrFail());
        $this->update(['password' => Hash::make($atributtes['password'])]);
        return redirect()->route('home');
    }
}
