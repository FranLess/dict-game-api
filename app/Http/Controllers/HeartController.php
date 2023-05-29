<?php

namespace App\Http\Controllers;

use App\Models\Heart;
use App\Http\Requests\StoreHeartRequest;
use App\Http\Requests\UpdateHeartRequest;

class HeartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeartRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Heart $heart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeartRequest $request, Heart $heart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Heart $heart)
    {
        //
    }
}
