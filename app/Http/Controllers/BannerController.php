<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Str;

class BannerController extends Controller
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
        $banners = Banner::all();
        return view('backend.banner',[
            'banners'=>$banners,
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
            'image'=>'required|max:2048',
            'link'=>'nullable',
        ];

        $validatedData = $request->validate($rules);

        if($request->image){
            $images = $request->image;
            $extention = $images->getClientOriginalExtension();
            $fileName = Str::random(5).rand(100000, 999999).'.'.$extention;
            $images->move(public_path('uploads/banner'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $banner = Banner::create($validatedData);

        if($banner){
            return back()->with('success', 'Banner create successfully.');
        }
        else{
            return back()->with('error', 'Failed to create Banner.');
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
        $banner = Banner::find($id);

        $rules = [
            'image'=>'nullable|max:2048',
            'link'=>'nullable',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = $request->status;

        if ($request->image) {
            $imagePath = public_path('uploads/banner/' . $banner->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/banner'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $banner->update($validatedData);

        if ($banner) {
            return back()->with('success', 'Banner updated successfully.');
        } else {
            return back()->with('error', 'Failed to update Banner.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        $filePath = public_path('uploads/banner/'. $banner->image);
        if(file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }

        $banner->delete();
        return back()->with('warning', 'Delete Successfully');
    }
}
