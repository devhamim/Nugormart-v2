<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\size;
use Illuminate\Http\Request;

class AttributeController extends Controller
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
        $colors = Color::all();
        return view('backend.product.color',[
            'colors'=>$colors,
        ]);
    }

    public function size_list()
    {
        $sizes = size::all();
        return view('backend.product.size',[
            'sizes'=>$sizes,
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
        if($request->btn == 1){
            $rules = [
                'name'=>'required|max:225',
                'code'=>'required|max:225',
            ];

            $validatedData = $request->validate($rules);

            $color = Color::create($validatedData);

            if($color){
                return back()->with('success', 'Color create successfully.');
            }
            else{
                return back()->with('error', 'Failed to create Color.');
            }
        }
        if($request->btn == 2){
            $rules = [
                'name'=>'required|max:225',
            ];

            $validatedData = $request->validate($rules);

            $size = size::create($validatedData);

            if($size){
                return back()->with('success', 'Size create successfully.');
            }
            else{
                return back()->with('error', 'Failed to create Size.');
            }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->delBtn == 1){
            $color = color::find($id);

            $color->delete();
            return back()->with('warning', 'Delete Successfully');
        }
        if($request->delBtn == 2){
            $size = size::find($id);

            $size->delete();
            return back()->with('warning', 'Delete Successfully');
        }

    }
}
