<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\DeliveryOption;

Use App\Helpers\Helper;

class ProductController extends Controller
{
  
    

    public function getProductDetails($encProductId)
    {
        $productId = Helper::skill_crypt($encProductId, 'd');
        //print_R($productId);exit;
        $productDetails = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
            ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
            ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
            ->where(['products.status'=>1, 'products.id'=>$productId])
            ->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage', 'products.parent_product_id', 'product_description', 'product_category_id', 'product_subcategory_id')->first();
            
        if(isset($productDetails->productId)){
            $productImages = ProductImage::where(['product_id'=>$productId, 'status'=>1])->get();
            
            if(isset($productDetails->parent_product_id) && $productDetails->parent_product_id == 0){
                $availablecolors = Product::where(['products.status'=>1, 'products.parent_product_id'=>$productId])->orwhere(['id'=>$productId])->select('product_color', 'id')->orwhere(['id'=>$productDetails->parent_product_id])->select('product_color', 'id')->distinct('product_color')->get();

                $availableSizes = Product::where(['products.status'=>1, 'products.parent_product_id'=>$productId])->orwhere(['id'=>$productId])->orwhere(['id'=>$productDetails->parent_product_id])->select('product_size', 'id')->distinct('product_size', 'id')->get();

                
            }else{
                    
                  
                
                $availablecolors = Product::where(['products.status'=>1, 'products.parent_product_id'=>$productId])->orwhere(['id'=>$productId])->orwhere(['products.parent_product_id'=>$productDetails->parent_product_id])->orwhere(['id'=>$productDetails->parent_product_id])->select('product_color', 'id', 'parent_product_id', 'products.status')->distinct('product_color')->get();
                
                $availableSizes = Product::where(['products.status'=>1, 'products.parent_product_id'=>$productId])->orwhere(['id'=>$productId])->orwhere(['products.parent_product_id'=>$productDetails->parent_product_id])->orwhere(['id'=>$productDetails->parent_product_id])->select('product_size', 'id')->get(); 

                
            }
            
           $optionalProduct = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
                ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
                ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
                ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
                ->where(['products.status'=>1, 'product_images.is_prime'=>1, 
                    'products.product_category_id'=>$productDetails->product_category_id, 
                    'products.product_subcategory_id'=>$productDetails->product_subcategory_id
                ])->where('products.id', '!=', $productId)
                
                ->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage', 'products.parent_product_id', 'product_description')->groupBy('products.id')->distinct()->get();

           

            

            
            $deliveryOptions = DeliveryOption::where(['status'=>1])->get();

            $productCount = Helper::getItemInventory($productId);
            return view('productDetail',compact('productDetails', 'productImages', 'deliveryOptions' , 'availablecolors', 'availableSizes', 'optionalProduct', 'productCount'));
        }else{
            return redirect('');
        }
        

    }
    
    public function getProductByCategory($encCategoryId)
    {
        $categoryId = Helper::skill_crypt($encCategoryId, 'd');
        $products = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
            ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
            ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
            ->where(['products.status'=>1, 'products.product_category_id'=>$categoryId, 'product_images.is_prime'=>1, 'products.is_prime'=>1, 'products.parent_product_id'=>0])->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage', 'product_category_id', 'products.product_subcategory_id', 'products.product_brand_id')->get();

        if(count($products) > 0){
            $category = Category::where(['id'=>$categoryId])->first();

            $categoryImageUrl = asset('images/category/'.$category->category_image_name);

            $brand = Brand::where(['status'=>1, 'brands_category_id'=>$categoryId])->select('brand_name', 'id')->get();

            $color = Product::where(['products.status'=>1, 'products.product_category_id'=>$categoryId])->where('product_color', '!=', '')->select('product_color')->distinct('product_color')->get();
            $subCategory = SubCategory::where(['status'=>1, 'category_id'=>$categoryId])->select('sub_category_name as category_name', 'id')->get();

            // $maxPriceVal =  Product::where(['products.status'=>1, 'products.product_category_id'=>$categoryId, 'products.is_prime'=>1, 'products.parent_product_id'=>0])->max('product_cost');
            // // print_R($maxPriceVal);exit;
            // $minPriceVal = Product::where(['products.status'=>1, 'products.product_category_id'=>$categoryId, 'products.is_prime'=>1, 'products.parent_product_id'=>0])->min('product_cost');
            // print_R($minPriceVal);exit;
            $minPriceVal = 100;
            $maxPriceVal = 10000000;


            return view('product',compact('products', 'category', 'brand', 'subCategory', 'categoryImageUrl', 'color', 'maxPriceVal', 'minPriceVal'));
        }else{
            return redirect('');
        }
    }

    public function getFilterProduct(Request $request)
    {          
        $input = $request->all();
        

    }
}
