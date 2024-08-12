<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
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
        $users = User::all();
        return view('backend.userlist',[
            'users'=>$users,
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
            'email'=>'required|unique:users|max:225',
            'number'=>'nullable|max:11|min:11',
            'address'=>'nullable|max:225',
            'image'=>'nullable|max:1024',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password',
        ];

        $validatedData = $request->validate($rules);

        if($request->image){
            $images = $request->image;
            $extention = $images->getClientOriginalExtension();
            $fileName = Str::random(5).rand(100000,999999).'.'.$extention;
            $images->move(public_path('uploads/user'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $user = User::create($validatedData);


        if ($user) {
            return back()->with('success', 'User create successfully.');
        } else {
            return back()->with('error', 'Failed to create user.');
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

        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|max:225',
            'email' => 'required|max:225',
            'number' => 'nullable|max:11|min:11',
            'address' => 'nullable|max:225',
            'image'=>'nullable|max:1024',
        ];

        $validatedData = $request->validate($rules);

        unset($validatedData['password_confirmation']);

        if ($request->hasFile('image')) {
            $imagePath = public_path('uploads/user/' . $user->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/user'), $fileName);

            $validatedData['image'] = $fileName;
        }

        $user->update($validatedData);

        if ($user) {
            return back()->with('success', 'User updated successfully.');
        } else {
            return back()->with('error', 'Failed to update user.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return back()->with('error', 'User not find');
        }

        $imagepsth = public_path('uploads/user/'. $user->image);
        if(file_exists($imagepsth) && is_file($imagepsth)){
            unlink($imagepsth);
        }

        $user->delete();
        return back()->with('warning', 'Delete Successfully');

    }
}
