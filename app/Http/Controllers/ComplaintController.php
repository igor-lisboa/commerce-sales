<?php

namespace App\Http\Controllers;

use App\Http\Requests\Complaint as RequestsComplaint;
use App\Models\Client;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    private $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('complaint.index', ['complaints' => $this->complaintService->index(5, 'page', $request->page ?? 1)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('complaint.form', ['clients' => Client::orderBy('cpf')->get(), 'client_id' => $request->client_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Complaint  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsComplaint $request)
    {
        $this->complaintService->store($request->validated());
        return redirect()->route('complaint.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        return view('complaint.form', ['complaint' => $complaint, 'clients' => Client::orderBy('cpf')->get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Complaint  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsComplaint $request, Complaint $complaint)
    {
        $this->complaintService->setModel($complaint);
        $this->complaintService->update($request->validated());
        return redirect()->route('complaint.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        $this->complaintService->setModel($complaint);
        $this->complaintService->destroy();
        return redirect()->route('complaint.index');
    }
}
