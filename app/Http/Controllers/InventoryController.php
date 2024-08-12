<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\size;
use Illuminate\Http\Request;
use Str;
use Image;

class InventoryController extends Controller
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
        $sizes = size::all();
        $inventorys = Inventory::all();
        $attributes = Attribute::all();
        return view('backend.product.attributelist',[
            'colors'=>$colors,
            'sizes'=>$sizes,
            'inventorys'=>$inventorys,
            'attributes'=>$attributes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = size::all();
        return view('backend.product.attribute',[
            'colors'=>$colors,
            'sizes'=>$sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:inventories',
            'brand' => 'nullable|string|max:255',
            'price.*' => 'required',
            'sell_price.*' => 'nullable',
            'quantity.*' => 'required',
            'color_id.*' => 'nullable',
            'size_id.*' => 'nullable',
            'weight.*' => 'nullable',
            'image.*' => 'required|image',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['slug'] = Str::lower(str_replace(' ','-',$request->name )) ;

        $mainInventory = Inventory::create([
            'title' => $validatedData['title'],
            'sku' => $validatedData['sku'],
            'brand' => $validatedData['brand'] ?? null,
            'slug' => $validatedData['slug'],
        ]);
        foreach ($validatedData['price'] as $key => $price) {
            $inventory = new Attribute();
            $inventory->inventorie_id = $mainInventory->id;
            $inventory->price = $price;
            $inventory->sell_price = $validatedData['sell_price'][$key] ?? null;
            $inventory->quantity = $validatedData['quantity'][$key];
            $inventory->color_id = $validatedData['color_id'][$key] ?? null;
            $inventory->size_id = $validatedData['size_id'][$key] ?? null;
            $inventory->weight = $validatedData['weight'][$key] ?? null;

            $image = $validatedData['image'][$key];
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            Image::make($image)->resize(600, 600)->save(public_path('uploads/product/'.$fileName));
            $inventory->image = $fileName;
            $inventory->save();
        }

        return back()->with('success', 'Attribute created successfully.');
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
        $inventory = Inventory::findOrFail($id);
        $colors = Color::all();
        $sizes = Size::all();
        return view('backend.product.attributeEdit',[
            'inventory'=>$inventory,
            'colors'=>$colors,
            'sizes'=>$sizes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // return $request->all();
    $request->validate([
        'title' => 'required|string|max:255',
        'sku' => 'required|string|max:255',
        'quantity' => 'required|array',
        'price' => 'required|array',
        'weight' => 'nullable',
        'color_id' => 'nullable',
        'size_id' => 'nullable',
        'status' => 'required',
    ]);

    $inventory = Inventory::findOrFail($id);
    $inventory->title = $request->title;
    $inventory->sku = $request->sku;
    $inventory->brand = $request->brand;
    $inventory->status = $request->status;
    $inventory->save();

    // Delete the details that were removed
    if ($request->has('delete_detail_id')) {
        Attribute::whereIn('id', $request->delete_detail_id)->delete();
    }

    // Update or create the details
    foreach ($request->quantity as $key => $value) {
        $inventoryDetail = Attribute::updateOrCreate(
            ['id' => $request->detail_id[$key] ?? null],
            [
                'inventorie_id' => $inventory->id,
                'quantity' => $value,
                'price' => $request->price[$key],
                'sell_price' => $request->sell_price[$key],
                'weight' => $request->weight[$key],
                'color_id' => $request->color_id[$key],
                'size_id' => $request->size_id[$key],
            ]
        );

        if (isset($request->image[$key])) {
            $image = $request->image[$key];
            $extension = $image->getClientOriginalExtension();
            $fileName = Str::random(5) . rand(100000, 999999) . '.' . $extension;
            Image::make($image)->resize(600, 600)->save(public_path('uploads/product/' . $fileName));
            $inventoryDetail->image = $fileName;
            $inventoryDetail->save();
        }
    }

    return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $inventory = Inventory::find($id);
        $attributes = Attribute::where('inventorie_id', $inventory->id)->get();

        if(Product::where('inventorie_id', $id)->exists()){
            return back()->with('warning', 'Inventory have product Please product delete fast');
        }
        else{
            foreach($attributes as $attribute){
                $filePath = public_path('uploads/product/'. $attribute->image);
                    if(file_exists($filePath) && is_file($filePath)){
                        unlink($filePath);
                    }

                $attribute->delete();
            }

            $inventory->delete();
            return back()->with('warning', 'Delete Successfully');
        }
    }
}
