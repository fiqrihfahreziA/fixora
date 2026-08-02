<?php

namespace App\Http\Controllers;

use App\Models\pengajuan_item;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storepengajuan_itemRequest;
use App\Http\Requests\Updatepengajuan_itemRequest;

class PengajuanItemController extends Controller
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
    public function store(Storepengajuan_itemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(pengajuan_item $pengajuan_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pengajuan_item $pengajuan_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatepengajuan_itemRequest $request, pengajuan_item $pengajuan_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pengajuan_item $pengajuan_item)
    {
        //
    }
}
