<?php

namespace App\Http\Controllers;

use App\Models\TermAndCondition;
use Illuminate\Http\Request;

class TermAndConditionController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $termandcondition = TermAndCondition::first();
        return view('backend.addtionalpage.termandcondition',[
            'termandcondition'=>$termandcondition,
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $termandcondition = TermandCondition::find($id);

        $rules = [
            'description'=>'required',
        ];

        $validatedData = $request->validate($rules);

        $termandcondition->update($validatedData);

        if ($termandcondition) {
            return back()->with('success', 'updated successfully.');
        } else {
            return back()->with('error', 'Failed to update.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
