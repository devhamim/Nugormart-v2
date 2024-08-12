<?php

namespace App\Http\Controllers;

use App\Models\DelevaryCharge;
use Illuminate\Http\Request;

class DelevaryChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delevaryCharges = DelevaryCharge::all();
        return view('backend.delevaryCharge',[
            'delevaryCharges'=>$delevaryCharges,
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
        $rules = [
            'name'=>'required|max:225',
            'charge'=>'required|max:225',
        ];

        $validatedData = $request->validate($rules);


        $delevaryCharge = DelevaryCharge::create($validatedData);

        if($delevaryCharge){
            return back()->with('success', 'create successfully.');
        }
        else{
            return back()->with('error', 'Failed to create.');
        }
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
        $delevaryCharge = DelevaryCharge::find($id);

        $rules = [
            'name'=>'nullable|max:225',
            'charge'=>'required|max:225',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = $request->status;


        $delevaryCharge->update($validatedData);

        if ($delevaryCharge) {
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
        $delevaryCharge = DelevaryCharge::find($id);

        $delevaryCharge->delete();
        return back()->with('warning', 'Delete Successfully');
    }
}
