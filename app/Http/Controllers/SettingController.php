<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Str;

class SettingController extends Controller
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
        $setting = Setting::first();
        return view('backend.setting',[
            'setting'=>$setting,
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
        $setting = Setting::findOrFail($id);

        $rules = [
            'name' => 'required|max:225',
            'email' => 'required|max:225',
            'address' => 'required|max:225',
            'number_one' => 'required|max:11|min:11',
            'number_two' => 'nullable|max:11|min:11',
            'title' => 'required|max:225',
            'footer' => 'required|max:225',
            'about' => 'required',
            'meta_title' => 'nullable|max:225',
            'meta_tag' => 'nullable|max:225',
            'meta_description' => 'nullable',
            'fb_pixel' => 'nullable',
            'google_tag' => 'nullable',
            'google_map' => 'nullable',
            'white_logo'=>'nullable|max:1024',
            'black_logo'=>'nullable|max:1024',
            'favicon'=>'nullable|max:1024',
            'tweeter_link'=>'nullable',
            'linkind_link'=>'nullable',
            'insta_link'=>'nullable',
            'youtube_link'=>'nullable',
            'fb_link'=>'nullable',
        ];

        $validatedData = $request->validate($rules);

        // white_logo

        if ($request->white_logo) {
            $imagePath = public_path('uploads/setting/' . $setting->white_logo);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->white_logo;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/setting'), $fileName);
            $validatedData['white_logo'] = $fileName;
        }

        // black_logo
        if ($request->black_logo) {
            $imagePath = public_path('uploads/setting/' . $setting->black_logo);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->black_logo;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/setting'), $fileName);
            $validatedData['black_logo'] = $fileName;
        }

        // favicon
        if ($request->favicon) {
            $imagePath = public_path('uploads/setting/' . $setting->favicon);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->favicon;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/setting'), $fileName);
            $validatedData['favicon'] = $fileName;
        }

        $setting->update($validatedData);

        if ($setting) {
            return back()->with('success', 'Setting updated successfully.');
        } else {
            return back()->with('error', 'Failed to update Setting.');
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
