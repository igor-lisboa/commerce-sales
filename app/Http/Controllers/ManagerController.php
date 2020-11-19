<?php

namespace App\Http\Controllers;

use App\Http\Requests\Manager as RequestsManager;
use App\Models\Manager;
use App\Models\User;
use App\Services\ManagerService;
use Illuminate\Http\Request;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('manager.index', ['managers' => $this->managerService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * Remove the specified resource from storage
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manager $manager)
    {
        // set the manager model as manager service's model 
        $this->managerService->setModel($manager);

        // destroy from db this manager register
        $this->managerService->destroy();

        // redirect back to manager index page
        return redirect()->route('manager.index');
    }
}
