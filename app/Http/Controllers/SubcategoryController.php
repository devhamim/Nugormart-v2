<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
        $categorys = Category::all();
        $subcategorys = Subcategory::all();
        return view('backend.subcategory',[
            'categorys'=>$categorys,
            'subcategorys'=>$subcategorys,
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
            'category_id'=>'nullable|max:11',
        ];

        $validatedData = $request->validate($rules);


        $subcategory = Subcategory::create($validatedData);

        if($subcategory){
            return back()->with('success', 'Subcategory create successfully.');
        }
        else{
            return back()->with('error', 'Failed to create Subcategory.');
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
        $subcategory = Subcategory::find($id);

        $rules = [
            'name'=>'nullable|max:225',
            'category_id'=>'nullable|max:11',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = $request->status;


        $subcategory->update($validatedData);

        if ($subcategory) {
            return back()->with('success', 'Subcategory updated successfully.');
        } else {
            return back()->with('error', 'Failed to update Subcategory.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::find($id);

        $subcategory->delete();
        return back()->with('warning', 'Delete Successfully');
    }
}
