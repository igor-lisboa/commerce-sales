<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIfIsManager;
use App\Http\Requests\UserAuth;
use App\Http\Requests\UserRegister;
use App\Http\Requests\UserUpdatePassword;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * show login page
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        // if user is already logged in redirect to home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('user.login');
    }

    /**
     * logout logged user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        return $this->userService->logout();
    }

    /**
     * Try make login
     *
     * @param  \App\Http\Requests\UserAuth  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(UserAuth $request)
    {
        // Retrieve the validated input data
        $validated = $request->validated();
        return $this->userService->auth($validated['email'], $validated['password'], $validated['remember'] ?? false);
    }

    /**
     * Show the form for edit current logged user.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser()
    {
        return $this->edit(auth()->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if the logged user isn't one manager redirect to your-user page
        if (auth()->user()->manager == null && $user->id != auth()->user()->id) {
            return redirect()->route('your_user');
        }
        return view('user.form', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CheckIfIsManager  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegister $request, User $user)
    {
        $this->userService->setModel($user);
        $this->userService->update($request->validated());
        return redirect()->route('user.edit', [$user]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if the logged user isn't one manager redirect to home
        if (auth()->user()->manager == null) {
            return redirect()->route('home');
        }
        return view('user.form');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\CheckIfIsManager
     */
    public function index(CheckIfIsManager $request)
    {
        return view('user.index', ['users' => $this->userService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CheckIfIsManager  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegister $request)
    {
        return $this->userService->register($request->name, $request->email);
    }

    /**
     * if the email is valid user will receive one email to update the password
     *
     * @param  \App\Http\Requests\CheckIfIsManager  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function userRequestChangePassword(Request $request)
    {
        return $this->userService->requestChangePassword($request->email);
    }

    /**
     * update the password
     *
     * @param  string $remember_token
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserUpdatePassword $request, $remember_token)
    {
        return $this->userService->updatePassword($remember_token, $request->validated());
    }

    /**
     * page to get the user's email to send the update password link
     *
     * @return \Illuminate\Http\Response
     */
    public function setUserChangePassword()
    {
        return view('user.email-change-password');
    }

    /**
     * show the page to update the password
     *
     * @param  string $remember_token
     * @return \Illuminate\Http\Response
     */
    public function changePassword($remember_token)
    {
        return view('user.update-password', ['user' => User::where('remember_token', '=', $remember_token)->firstOrFail()]);
    }

    /**
     * Remove the specified resource from storage and use the CheckIfIsManager to verify if the logged user can do it
     *
     * @param  \App\Http\Requests\CheckIfIsManager  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckIfIsManager $request, User $user)
    {
        // set the user model as user service's model 
        $this->userService->setModel($user);

        // destroy from db this user register
        $this->userService->destroy();

        // redirect back to user index page
        return redirect()->route('user.index');
    }
}
