<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckIfIsManager;
use App\Http\Requests\UserAuth;
use App\Http\Requests\UserRegister;
use App\Models\User;
use App\Services\UserService;
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
     * @param  UserRegister  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegister $request)
    {
        return $this->userService->register($request->name, $request->email);
    }

    /**
     * Remove the specified resource from storage and use the CheckIfIsManager to verify if the logged user can do it
     *
     * @param  \App\Http\Requests\Manager  $request
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
