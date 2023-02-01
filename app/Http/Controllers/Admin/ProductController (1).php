<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Brand;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $type = isset($_GET['type']) ? $_GET['type'] : '1';
        $btnStatus = ($type == '1') ? '0' : '1';
        $products = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
            ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
            ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
            ->where(['products.status'=>$type, 'product_images.is_prime'=>1, 'product_images.status'=>1])->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'products.is_prime', 'product_images.image_name')->get();
        return view('admin.product.index',compact('products', 'type', 'btnStatus'));
    }

    public function create(Request $request)
    {
        $products = Product::where(['status'=>1, 'parent_product_id' => 0])->select('id', 'product_name as name')->get();
        $categories = Category::where(['status'=>1])->select('id', 'category_name as name')->get();
        $brands = Brand::where(['status'=>1])->select('id', 'brand_name as name')->orderBy('id')->get();
        $subCategories = SubCategory::where(['status'=>1])->select('id', 'sub_category_name as name')->orderBy('id')->get();
        return view('admin.product.create',compact('categories', 'brands', 'subCategories', 'products'));
        
    }

    
    public function store(Request $request)
    {          
        $inputData = $request->all();
        if(isset($inputData['id']) && !empty($inputData['id'])){
            $productId = $inputData['id'];
            $edit = true;
        }else{
            $edit = false;
        }
        $insertData['product_name'] =  $inputData['product_name'];
        $insertData['parent_product_id'] =  $inputData['parent_product_id'];
        $insertData['product_category_id'] =  $inputData['product_category_id'];
        $insertData['product_brand_id'] =  $inputData['product_brand_id'];
        $insertData['product_subcategory_id'] =  $inputData['product_subcategory_id'];
        $insertData['product_color'] =  $inputData['product_color'];
        $insertData['product_size'] =  $inputData['product_size'];
        $insertData['product_cost'] =  $inputData['product_cost'];
        $insertData['product_description'] = $inputData['product_description'];
        $insertData['status'] =  1;
        if(!$edit){
            $createProduct = Product::create($insertData);
            $productId = $createProduct->id;
        }else{
            $createCategory = Product::where(['id'=>$productId])->update($insertData);
        }
        if($productId){
            if(isset($inputData['productImage']) && !empty($inputData['productImage'])){
                foreach($inputData['productImage'] as $imageArrayKey=>$imageArrayVal){
                    // if($file = $request->hasFile($inputData['productImage'][$imageArrayKey])){
                        $productImage = $inputData['productImage'][$imageArrayKey];
                        $orgImage_name = $productImage->getClientOriginalName();
                        $image_name = $orgImage_name;
                        $path = $productImage->move('public/images/product/',$image_name);        
                    // }
                    $insertImageData['product_id'] =  $productId;
                    $insertImageData['image_name'] =  $image_name;
                    $insertImageData['is_prime'] =  0;
                    $insertImageData['status'] =  1;
                    $createProductImage = ProductImage::create($insertImageData);
                }
            }
            
        }
        
        
        
        
        return redirect('admin/product');
        
        
        
        
    }

    public function edit(Request $request)
    {
        $productId = isset($_GET['product']) ? $_GET['product'] : '0';
        if(!empty($productId)){
            $productDetails = Product::where(['id'=>$productId])->first();
            if($productDetails){
                $product_category_id = $productDetails->product_category_id;
                $products = Product::where(['status'=>1, 'parent_product_id' => 0, 'product_category_id'=>$product_category_id])->where('id', '!=', $productId)->select('id', 'product_name as name')->get();
                
                $categories = Category::where(['status'=>1])->select('id', 'category_name as name')->get();
                $brands = Brand::where(['status'=>1, 'brands_category_id'=>$product_category_id])->select('id', 'brand_name as name')->orderBy('id')->get();
                $subCategories = SubCategory::where(['status'=>1, 'category_id'=>$product_category_id])->select('id', 'sub_category_name as name')->orderBy('id')->get();
                
                return view('admin.product.create',compact('productDetails', 'products', 'categories', 'brands', 'subCategories'));
            }else{
                return redirect('admin/product');
            }
        }else{
            return redirect('admin/product');
        }
        
    }

    public function GetImageData(Request $request)
    {
        $productId = isset($_GET['product']) ? $_GET['product'] : '0';
        if(!empty($productId)){
            $productImage = ProductImage::where(['product_id'=>$productId])->get()->toArray();
            $productDetails = Product::where(['id'=>$productId])->first();
            if(!empty($productImage)){
                foreach($productImage as $productImageKey=>$productImageVal){
                    $productImages[$productImageKey]['image_name'] = $productImageVal['image_name'];
                    $productImages[$productImageKey]['is_prime'] = $productImageVal['is_prime'];
                    $productImages[$productImageKey]['status'] = $productImageVal['status'];
                    $productImages[$productImageKey]['updated_at'] = $productImageVal['updated_at'];
                    $productImages[$productImageKey]['id'] = $productImageVal['id'];
                }
                
                
            }else{
                $productImages = [];

            }
            return view('admin.product.images',compact('productImages', 'productDetails'));
            
        }else{
            return redirect('admin/product');   
        }
    }

}
