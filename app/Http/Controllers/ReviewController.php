<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Str;

class ReviewController extends Controller
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
        $reviews = Review::all();
        return view('backend.review',[
            'reviews'=>$reviews,
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
            'title'=>'nullable',
        ];

        $validatedData = $request->validate($rules);

        if($request->image){
            $images = $request->image;
            $extention = $images->getClientOriginalExtension();
            $fileName = Str::random(5).rand(100000, 999999).'.'.$extention;
            $images->move(public_path('uploads/review'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $review = Review::create($validatedData);

        if($review){
            return back()->with('success', 'Review create successfully.');
        }
        else{
            return back()->with('error', 'Failed to create Review.');
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
        $reviews = Review::find($id);

        $rules = [
            'image'=>'nullable|max:2048',
            'title'=>'nullable',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['status'] = $request->status;

        if ($request->image) {
            $imagePath = public_path('uploads/review/' . $reviews->image);
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            $image->move(public_path('uploads/review'), $fileName);
            $validatedData['image'] = $fileName;
        }

        $reviews->update($validatedData);

        if ($reviews) {
            return back()->with('success', 'Review updated successfully.');
        } else {
            return back()->with('error', 'Failed to update Review.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reviews = Review::find($id);

        $filePath = public_path('uploads/review/'. $reviews->image);
        if(file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }

        $reviews->delete();
        return back()->with('warning', 'Delete Successfully');
    }
}
