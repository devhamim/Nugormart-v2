<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
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
        return view('backend.category',[
            'categorys'=>$categorys,
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
        ];

        $validatedData = $request->validate($rules);
        if($request->image){
            $images = $request->image;
            $extention = $images->getClientOriginalExtension();
            $fileName = Str::random(5).rand(100000, 999999).'.'.$extention;
            $images->move(public_path('uploads/category'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $category = Category::create($validatedData);

        if($category){
            return back()->with('success', 'Category create successfully.');
        }
        else{
            return back()->with('error', 'Failed to create Category.');
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
        $category = Category::find($id);

        $rules = [
            'name'=>'nullable|max:225',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = $request->status;

        if ($request->image) {
            $imagePath = public_path('uploads/category/' . $category->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/category'), $fileName);
            $validatedData['image'] = $fileName;
        }


        $category->update($validatedData);

        if ($category) {
            return back()->with('success', 'Category updated successfully.');
        } else {
            return back()->with('error', 'Failed to update Category.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        $filePath = public_path('uploads/category/'. $category->image);
        if(file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }

        $category->delete();
        return back()->with('warning', 'Delete Successfully');
    }
}
