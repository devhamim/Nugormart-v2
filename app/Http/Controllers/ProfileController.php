<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;
use Hash;

class ProfileController extends Controller
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
        $profile = User::find(Auth::user()->id);
        return view('backend.profile',[
            'profile'=>$profile,
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
        $rules = [
            'name'=>'required|max:225',
            'email'=>'required|max:225',
            'number'=>'nullable|max:11|min:11',
            'address'=>'nullable|max:225',
        ];
        if($request->password){
            $rules['oldPassword'] = 'required|min:6';
            $rules['password'] = 'required|min:6|confirmed';
            $rules['password_confirmation'] = 'required|min:6';
        }

        $validatedData = $request->validate($rules);

        if ($request->password) {
            if (!Hash::check($request->oldPassword, Auth::user()->password)) {
                return back()->withErrors(['oldPassword' => 'The provided password does not match your current password.'])->withInput();
            }
        }

        if ($request->password) {
            $validatedData['password'] = Hash::make($request->password);
        }
        if($request->image){
            $images = $request->image;
            $extention = $images->getClientOriginalExtension();
            $fileName = Str::random(5).rand(100000, 999999).'.'.$extention;
            $images->move(public_path('uploads/user'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $user = User::find(Auth::user()->id);
        $user->update($validatedData);
        return back()->with('success', 'Profile Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
