<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\OrderProduct;
use App\Models\PrivacyPolicy;
use App\Models\Product;
use App\Models\Review;
use App\Models\TermAndCondition;
use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{
    //home
    function home(){
        $banners = Banner::where('status', 1)->get();
        $categorys = Category::where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        $reviews = Review::where('status', 1)->get();

        $topSellingProducts = Product::join('order_products', 'products.id', '=', 'order_products.product_id')
    ->take(20)
    ->get();
        return view('frontend.index',[
            'banners'=>$banners,
            'categorys'=>$categorys,
            'products'=>$products,
            'reviews'=>$reviews,
            'topSellingProducts'=>$topSellingProducts,
        ]);
    }

    // product_details
    function product_details($slug){
        $products = Product::where('slug', $slug)->get();
        $attributes = Attribute::where('inventorie_id', $products->first()->inventorie_id)->get();

        $available_colors = $attributes->groupBy('rel_to_color.id');

        $related_product = Product::where('category_id', $products->first()->category_id)->get();
        $termscondition = TermAndCondition::first();
        return view('frontend.product_details',[
            'products'=>$products,
            'attributes' => $attributes,
            'available_colors' => $available_colors,
            'termscondition' => $termscondition,
            'related_product' => $related_product,
        ]);
    }
    
   // getProductDetails
    public function getProductDetails(Request $request)
{
    $attribute_id = $request->input('attribute_id');
    $inventoryId = $request->input('inventorie_id');
    $color = $request->input('color');

    if($color){
        $productDetails = Attribute::where('inventorie_id', $inventoryId)
            ->where('color_id', $color)
            ->first();
    }elseif($attribute_id){
        $productDetails = Attribute::where('inventorie_id', $inventoryId)
            ->where('id', $attribute_id)
            ->first();
    }

    if ($productDetails) {
        return response()->json([
            'price' => $productDetails->price,
            'sell_price' => $productDetails->sell_price,
            'quantity' => $productDetails->quantity,
            'image' => $productDetails->image,
        ]);
    } else {
        return response()->json(['error' => 'Product details not found.'], 404);
    }
}

    //getsize
    public function getsize(Request $request)
    {
        $attribute = Attribute::where('inventorie_id', $request->inventorie_id)
                               ->where('color_id', $request->color_id)
                               ->get();
                               
        $str = '<h5>Size:</h5><div class="product-nav product-nav-thumbs product_details_size">';
    
        foreach($attribute as $size){
            if($size->size_id){
            $str .= '<div class="size-option form-option form-check-inline mb-2">
                        
                        <input class="burmanRadio__input size_id" type="radio" name="attribute_id" id="'.$size->size_id.'" value="'.$size->id.'" required>
                        <label class="burmanRadio__label" for="'.$size->size_id.'">'.$size->size_id.'</label>
                    </div>';
            }
        }
        
        $str .= '</div>';
    
        return response()->json(['html' => $str]);
    }


    // category_details
    function category_show($category){
        $products = Product::where('category_id', $category)->with('rel_to_inventorie')->paginate(30);
        return view('frontend.category_product',[
            'products'=>$products,
        ]);
    }
    // subcategory_show
    function subcategory_show($subcategory){
        $products = Product::where('subcategory_id', $subcategory)->with('rel_to_inventorie')->paginate(30);
        return view('frontend.category_product',[
            'products'=>$products,
        ]);
    }

    // shop
      //shop
      function shop(Request $request){
        // search
        $data = $request->all();

        $products = Product::where(function($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function($q) use ($data){
                    $q->where('name', 'like', '%'.$data['q'].'%');
                    $q->orWhere('tag', 'like', '%'.$data['q'].'%');
                    $q->orWhere('description', 'like', '%'.$data['q'].'%');
                    $q->orWhere('slug', 'like', '%'.$data['q'].'%');
                });
            }
            if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
                $q->where('category_id', $data['category_id']);
            }

        })->where('status', 1)->paginate(30)->withQueryString();

        // search product count
        $products_count = $products->count();

        $categorys = category::all();
       return view('frontend.shop', [
           'products'=>$products,
           'categorys'=>$categorys,
           'products_count'=>$products_count,
       ]);
   }

   //about_us
   function about_us(){
    $abouts = About::where('status', 1)->first();
    return view('frontend.about',[
        'abouts'=>$abouts,
    ]);
}

//privacy_policy
function privacy_policy(){
    $privacypolicy = PrivacyPolicy::first();
    return view('frontend.privacy_policy',[
        'privacypolicy'=>$privacypolicy,
    ]);
}

//terms_condition
function terms_condition(){
    $termscondition = TermAndCondition::first();
    return view('frontend.termandcondition',[
        'termscondition'=>$termscondition,
    ]);
}
}
