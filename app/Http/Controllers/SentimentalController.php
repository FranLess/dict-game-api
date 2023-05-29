<?php

namespace App\Http\Controllers;

use App\Models\Sentimental;
use App\Http\Requests\StoreSentimentalRequest;
use App\Http\Requests\UpdateSentimentalRequest;

class SentimentalController extends Controller
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
    public function store(StoreSentimentalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sentimental $sentimental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSentimentalRequest $request, Sentimental $sentimental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sentimental $sentimental)
    {
        //
    }
}
