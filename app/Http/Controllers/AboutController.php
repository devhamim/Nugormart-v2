<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Str;

class AboutController extends Controller
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
        $abouts = About::first();
        return view('backend.addtionalpage.about',[
            'abouts'=>$abouts,
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
        $abouts = about::find($id);

        $rules = [
            // 'image'=>'nullable|max:2048',
            // 'title'=>'required|max:225',
            'description'=>'required',
        ];

        $validatedData = $request->validate($rules);

        if ($request->image) {
            $imagePath = public_path('uploads/about/' . $abouts->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/about'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $abouts->update($validatedData);

        if ($abouts) {
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
