<?php

namespace App\Http\Controllers;

use App\Models\AllNotes;
use Illuminate\Http\Request;

class AllNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('allnotes.allnote');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AllNotes $allNotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AllNotes $allNotes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AllNotes $allNotes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AllNotes $allNotes)
    {
        //
    }
}
