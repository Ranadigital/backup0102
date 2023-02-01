<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\DeliveryOption;
use App\Banner;
use Config;

class WelcomeController extends Controller
{
  
    

    
    public function getWelcomeView(Request $request)
    {          
        $bannres = Banner::where(['status' => 1])->get();
        $categories = Category::where(['status'=>1])->whereNotIn('id', [5,7])->get();
        $catData = [];
        foreach($categories as $categoryKey=>$category){
            $catId = $category->id;
            $catName = $category->category_name;
            $products = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
                ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
                ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
                ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
                ->where(['products.status'=>1, 'products.product_category_id'=>$catId, 'product_images.is_prime'=>1, 'products.is_prime'=>1, 'products.parent_product_id'=>0 ])->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage')->get();
            $catData[$categoryKey]['category']['id'] = $catId;
            $catData[$categoryKey]['category']['name'] = $catName;
            $catData[$categoryKey]['category']['products'] = $products;


        }
        return view('welcome',compact('bannres', 'catData'));
    }

    
    
    
}
