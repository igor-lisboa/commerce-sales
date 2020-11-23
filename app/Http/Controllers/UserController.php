<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuth;
use App\Http\Requests\UserRegister;
use App\Http\Requests\UserUpdatePassword;
use App\Models\Session;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('is.manager', ['only' => ['destroy', 'store', 'index', 'create']]);
    }

    /**
     * show login page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        // if user is already logged in redirect to home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('user.login', ['redirect' => $request->redirect ?? '']);
    }

    /**
     * logout logged user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->userService->logout();
        return redirect()->route('login');
    }

    /**
     * Try make login
     *
     * @param  \App\Http\Requests\UserAuth  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(UserAuth $request)
    {
        try {
            // Retrieve the validated input data
            $validated = $request->validated();
            $this->userService->auth($validated['email'], $validated['password'], $validated['remember'] ?? false);
            // if the auth is ok send to home or redirect value if is defined
            if ($request->redirect) {
                return redirect($request->redirect);
            } else {
                return redirect()->route('home');
            }
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
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
     * @param  \App\Http\Requests\UserRegister  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRegister $request, User $user)
    {
        // if the logged user isn't one manager redirect to your-user page
        if (auth()->user()->manager == null && $user->id != auth()->user()->id) {
            return redirect()->route('your_user');
        }
        $this->userService->setModel($user);
        $this->userService->update($request->validated());
        return redirect()->route('user.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        return view('user.index', ['users' => $this->userService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRegister  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegister $request)
    {
        $this->userService->register($request->name, $request->email);

        // redirect to home
        return redirect()->route('user.index');
    }

    /**
     * if the email is valid user will receive one email to update the password
     *
     * @param  Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function userRequestChangePassword(Request $request)
    {
        $this->userService->requestChangePassword($request->email);
        // redireciona p login
        return redirect()->route('login');
    }

    /**
     * get active user sessions on the system
     *
     * @return \Illuminate\Http\Response
     */
    public function activeUsers()
    {
        return view('user.active-users', ['activeUserSessions' => Session::whereNotNull('user_id')->orderBy('last_activity', 'desc')->get()]);
    }

    /**
     * update the password
     *
     * @param  string $remember_token
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UserUpdatePassword $request, $remember_token)
    {
        $this->userService->updatePassword($remember_token, $request->validated());
        return redirect()->route('home');
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
     * Remove the specified resource from storage
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // set the user model as user service's model 
        $this->userService->setModel($user);

        // destroy from db this user register
        $this->userService->destroy();

        // redirect back to user index page
        return redirect()->route('user.index');
    }
}
