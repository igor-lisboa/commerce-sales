<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manager as RequestsManager;
use App\Models\Manager;
use App\Models\User;
use App\Services\ManagerService;

class ManagerController extends Controller
{
    private $managerService;

    public function __construct(ManagerService $managerService)
    {
        $this->managerService = $managerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if the logged user isn't one manager redirect to home
        if (auth()->user()->manager == null) {
            return redirect()->route('home');
        }
        return view('manager.index', ['managers' => $this->managerService->index()]);
    }

    /**
     *
     * @param  \App\Http\Requests\Manager  $request
     * @return \Illuminate\Http\Response
     */
    public function create(RequestsManager $request)
    {
        // if the logged user isn't one manager redirect to home
        if (auth()->user()->manager == null) {
            return redirect()->route('home');
        }
        return view('manager.create', ['usersNotManagers' => User::whereDoesntHave('manager')->get()]);
    }

    /**
     * Store a newly created resource in storage and use the RequestsManager to verify if the logged user can do it
     *
     * @param  \App\Http\Requests\Manager  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsManager $request)
    {
        $this->managerService->store($request->validated());
        return redirect()->route('manager.index');
    }

    /**
     * Remove the specified resource from storage and use the RequestsManager to verify if the logged user can do it
     *
     * @param  \App\Http\Requests\Manager  $request
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestsManager $request, Manager $manager)
    {
        // set the manager model as manager service's model 
        $this->managerService->setModel($manager);

        // destroy from db this manager register
        $this->managerService->destroy();

        // redirect back to manager index page
        return redirect()->route('manager.index');
    }
}