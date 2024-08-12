<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\size;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Str;
use Image;

class ProductController extends Controller
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
        $products = Product::all();
        return view('backend.product.listproduct',[
            'products'=>$products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $colors = Color::all();
        $sizes = size::all();
        $categoreys = Category::where('status', 1)->get();
        $subcategoreys = Subcategory::where('status', 1)->get();
        $inventorys = Inventory::where('status', 1)->get();
        return view('backend.product.addproduct',[
            'categoreys'=>$categoreys,
            'subcategoreys'=>$subcategoreys,
            'inventorys'=>$inventorys,
            'colors'=>$colors,
            'sizes'=>$sizes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){

        if($request->inventorie_id != null){

            $rules = [
                'inventorie_id'=>'required',
                'name'=>'required|max:225',
                'category_id'=>'required',
                'subcategory_id'=>'required',
                'brand'=>'nullable|max:225',
                'description'=>'required',
                'tag'=>'required',
            ];

            $validatedData = $request->validate($rules);

            $validatedData['slug'] = Str::lower(str_replace(' ','-',$request->name )).'-'.Str::random(32) ;

            $product = Product::create($validatedData);

            if($product){
                return back()->with('success', 'Product create successfully.');
            }
            else{
                return back()->with('error', 'Failed to create Product.');
            }
        }
        else{
            $rules = [
                'inventorie_id'=>'nullable',
                'name'=>'required|max:225',
                'category_id'=>'required',
                'subcategory_id'=>'required',
                'image'=>'required|max:2048',
                'color_id'=>'nullable',
                'size_id'=>'nullable',
                'weight'=>'nullable',
                'brand'=>'nullable|max:225',
                'quantity'=>'required|max:11',
                'price'=>'required|max:11',
                'sell_price'=>'nullable|max:11',
                'sku'=>'required|max:225',
                'description'=>'required',
                'tag'=>'required',
            ];

            $validatedData = $request->validate($rules);

            $validatedData['slug'] = Str::lower(str_replace(' ','-',$request->name )).'-'.Str::random(32) ;
            if($request->image){
                $images = $request->image;
                $extention = $images->getClientOriginalExtension();
                $fileName = Str::random(5).rand(100000, 999999).'.'.$extention;
                Image::make($images)->resize(600, 600)->save(public_path('uploads/product/'.$fileName));
                $validatedData['image'] = $fileName;
            }

            $product = Product::create($validatedData);

            if($product){
                return back()->with('success', 'Product create successfully.');
            }
            else{
                return back()->with('error', 'Failed to create Product.');
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
        $products = Product::find($id);
        $categoreys = Category::where('status', 1)->get();
        $subcategoreys = Subcategory::where('status', 1)->get();
        $allinventorys = Inventory::where('status', 1)->get();
        $inventorys = Inventory::where('status', 1)->where('id', $products->inventorie_id)->with('rel_to_attribute')->get();
        $colors = Color::all();
        $sizes = size::all();
        return view('backend.product.editproduct',[
            'products'=>$products,
            'categoreys'=>$categoreys,
            'subcategoreys'=>$subcategoreys,
            'inventorys'=>$inventorys,
            'colors'=>$colors,
            'sizes'=>$sizes,
            'allinventorys'=>$allinventorys,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if($request->inventorie_id != null){

            $rules = [
                'inventorie_id'=>'required',
                'name'=>'required|max:225',
                'category_id'=>'required',
                'subcategory_id'=>'required',
                'brand'=>'nullable|max:225',
                'description'=>'required',
                'tag'=>'required',
            ];

            $validatedData = $request->validate($rules);

            $product->update($validatedData);

            if($product){
                return back()->with('success', 'Product update successfully.');
            }
            else{
                return back()->with('error', 'Failed to update Product.');
            }
        }
        else{
            $rules = [
                'inventorie_id'=>'nullable',
                'name'=>'required|max:225',
                'category_id'=>'required',
                'subcategory_id'=>'required',
                'image'=>'required|max:2048',
                'color_id'=>'nullable',
                'size_id'=>'nullable',
                'weight'=>'nullable',
                'brand'=>'nullable|max:225',
                'quantity'=>'required|max:11',
                'price'=>'required|max:11',
                'sell_price'=>'nullable|max:11',
                'sku'=>'required|max:225',
                'description'=>'required',
                'tag'=>'required',
            ];

            $validatedData = $request->validate($rules);

            if($request->image){
                $images = $request->image;
                $extention = $images->getClientOriginalExtension();
                $fileName = Str::random(5).rand(100000, 999999).'.'.$extention;
                Image::make($images)->resize(600, 600)->save(public_path('uploads/product/'.$fileName));
                $validatedData['image'] = $fileName;
            }

            $product->update($validatedData);

            if($product){
                return back()->with('success', 'Product update successfully.');
            }
            else{
                return back()->with('error', 'Failed to update Product.');
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        $filePath = public_path('uploads/product/'. $product->image);
        if(file_exists($filePath) && is_file($filePath)){
            unlink($filePath);
        }

        $product->delete();
        return back()->with('warning', 'Delete Successfully');
    }

    public function getsubcategory(Request $request){
        $subcategorys = Subcategory::where('category_id', $request->category_id)->get();
        $str = '<option value="">-- Selected Subcategory --</option>';

        foreach($subcategorys as $subcategory){
            $str .= '<option value="'.$subcategory->id.'">'.$subcategory->name.'</option>';
        }

        echo $str;
    }


    public function getinventorydata(Request $request){
        $inventory = Inventory::findOrFail($request->inventorie_id);

        $attributes = $inventory->rel_to_attribute;

        $colors = Color::all()->keyBy('id');
        $sizes = Size::all()->keyBy('id');

        $attributeData = [];

        foreach ($attributes as $attribute) {
            if($attribute->weight != null){
                $attributeData[] = [
                    'price' => $attribute->price,
                    'weight' => $attribute->weight,
                    'sell_price' => $attribute->sell_price,
                    'quantity' => $attribute->quantity,
                    'image' => $attribute->image,
                ];
            }
            else{
                $attributeData[] = [
                    'price' => $attribute->price,
                    'color_id' => $attribute->color_id,
                    'color_name' => $colors[$attribute->color_id]->name ?? 'N/A',
                    'color_code' => $colors[$attribute->color_id]->code ?? '#FFFFFF',
                    'size_id' => $attribute->size_id,
                    'size_name' => $sizes[$attribute->size_id]->name ?? 'N/A',
                    'sell_price' => $attribute->sell_price,
                    'quantity' => $attribute->quantity,
                    'image' => $attribute->image,
                ];
            }
        }

        $relatedData = [
            'title' => $inventory->title,
            'sku' => $inventory->sku,
            'brand' => $inventory->brand,
            'attributes' => $attributeData,
        ];

        return response()->json($relatedData);
    }
}
