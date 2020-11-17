<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuth;
use App\Http\Requests\UserRegister;
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
     * @param  UserAuth  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(UserAuth $request)
    {
        // Retrieve the validated input data
        $validated = $request->validated();
        return $this->userService->auth($validated['email'], $validated['password'], $validated['remember'] ?? false);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRegister  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegister $request)
    {
        return $this->userService->register($request->name, $request->email, $request->password);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
