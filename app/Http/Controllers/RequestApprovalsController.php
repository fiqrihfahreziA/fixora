<?php

namespace App\Http\Controllers;

use App\Models\request_approvals;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storerequest_approvalsRequest;
use App\Http\Requests\Updaterequest_approvalsRequest;

class RequestApprovalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storerequest_approvalsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(request_approvals $request_approvals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(request_approvals $request_approvals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updaterequest_approvalsRequest $request, request_approvals $request_approvals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(request_approvals $request_approvals)
    {
        //
    }
}
