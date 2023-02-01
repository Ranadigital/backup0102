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
use App\OrderProductMapping;
use App\OrderDetail;
use App\Mail\OrderMail;
use Mail;
Use App\Helpers\Helper;

class AjaxController extends Controller
{
  
    

    
    public function getData(Request $request)
    {          
        $input = $request->all();
        $id = $input['id'];
        $categories = SubCategory::where(['status'=>1, 'category_id'=>$id])->select('id', 'sub_category_name as name')->orderBy('id')->get()->toArray();
        $brands = Brand::where(['status'=>1, 'brands_category_id'=>$id])->select('id', 'brand_name as name')->orderBy('id')->get()->toArray();
        $products = Product::where(['status'=>1, 'product_category_id'=>$id])->select('id', 'product_name as name')->orderBy('id')->get()->toArray();
        return response()->json(['code' => 200, 'categories'=> $categories, 'brands'=>$brands, 'products'=>$products]);
    }

    
    
    public function sendMail(Request $request)
    {          
        $orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
        // $order = OrderDetail::where(['id'=>$orderId])->first()->toArray();
        // $orderProduct = OrderProductMapping::leftjoin('products', 'products.id', '=', 'order_product_mappings.product_id')
        //     ->where(['order_product_mappings.order_id'=>$orderId])
        //     ->select('products.product_name', 'products.product_color', 'products.product_size', 'order_product_mappings.product_cost', 'order_product_mappings.product_count', 'products.id as productId', 'products.product_size')
        //     ->get()->toArray();
        // $orderData = $order;
        // $orderData['product'] = $orderProduct;
        // $emails = ['Jayarajan.Mangottil@gsa.omanair.com', 'buthaina.alriyami@omanair.com','niyaz.albalushi@omanair.com', 'customerserviceteam@muscatdutyfree.com'];
        // if(Mail::to('ateevmishra1989@gmail.com')->bcc($emails)->send(new OrderMail($orderData))){
        //     print_R('Mail Send');exit;
        // }else{
        //     print_R('Unable to send mail');exit;
        // }

        $test = $this->sendOrderMail('ateevmishra1989@gmail.com', $orderId);
        if($test){
            print_R('Mail Send');exit;
        }else{
            print_R('Unable to send mail');exit; 
        }
        


    }

    public function sendOrderMail($clientEmail, $orderId)
    {          
        //$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
        $order = OrderDetail::where(['id'=>$orderId])->first()->toArray();
        $orderProduct = OrderProductMapping::leftjoin('products', 'products.id', '=', 'order_product_mappings.product_id')
            ->where(['order_product_mappings.order_id'=>$orderId])
            ->select('products.product_name', 'products.product_color', 'products.product_size', 'order_product_mappings.product_cost', 'order_product_mappings.product_count', 'products.id as productId', 'products.product_size')
            ->get()->toArray();
        $orderData = $order;
        $orderData['product'] = $orderProduct;
        $emails = ['Jayarajan.Mangottil@gsa.omanair.com', 'buthaina.alriyami@omanair.com','niyaz.albalushi@omanair.com', 'eswaran@muscatdutyfree.com', 'customerserviceteam@muscatdutyfree.com'];
        if(Mail::to($clientEmail)->bcc($emails)->send(new OrderMail($orderData))){
            return true;
        }else{
            return false;
        }
        


    }
    public function searchProduct(Request $request)
    {          
        $searchInput = isset($_GET['search_text']) ? $_GET['search_text'] : '';

        if($searchInput != ''){
            $category = Category::where('category_name','LIKE','%'.$searchInput.'%')->first();
            if(isset($category->id) && !empty($category->id)){
                $products = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
                ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
                ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
                ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
                ->where(['products.status'=>1, 'product_images.is_prime'=>1, 'products.is_prime'=>1, 'products.parent_product_id'=>0, 'products.product_category_id'=>$category->id])->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage', 'product_category_id', 'products.product_subcategory_id', 'products.product_brand_id')->get();
            }else{
                $products = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
                ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
                ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
                ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
                ->where('product_name','LIKE','%'.$searchInput.'%')
                ->where(['products.status'=>1, 'product_images.is_prime'=>1, 'products.is_prime'=>1, 'products.parent_product_id'=>0])->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage', 'product_category_id', 'products.product_subcategory_id', 'products.product_brand_id')->get();
            }
            
        }else{
            $products = [];
        }
        return view('searchProduct',compact('products', 'searchInput'));
    }

    public function getCartView(Request $request)
    {          
        $input = $request->all();
        $cartStr = $input['product'];
        $cartArray = explode('/',$cartStr);
        $loopCount = 0;
        $newCartStr = '';
        $resArray = [];
        $productCartArray = [];
        $productChkArray = [];
        foreach($cartArray as $cartKey=>$cartVal){
            if(!empty($cartVal)){
                $productArray = explode('-',$cartVal);
                $productId = $productArray[0];
                $productCount = $productArray[1];
                if(isset($input['productId']) && $productId == $input['productId']){
                    $loopFlag =false;
                }else{
                    $loopFlag =true;
                }
                if($loopFlag){
                    if(in_array($productId, $productChkArray)){
                        $productCartArray[$productId]['count'] = $productCartArray[$productId]['count']+1;
                    }else{
                        array_push($productChkArray, $productId);
                        $productCartArray[$productId]['count'] = $productCount;
                        $productDetails = Product::leftjoin('brands', 'brands.id', '=', 'products.product_brand_id')
                        ->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
                        ->leftjoin('product_images', 'product_images.product_id', '=', 'products.id')
                        ->leftjoin('sub_categories', 'sub_categories.id', '=', 'products.product_subcategory_id')
                        ->where(['products.status'=>1, 'products.id'=>$productId, 'product_images.is_prime'=>1])
                        ->select('category_name', 'sub_category_name', 'brand_name', 'product_cost', 'product_color', 'product_size', 'products.status', 'products.id as productId', 'product_name', 'products.updated_at', 'product_images.image_name as productImage', 'products.parent_product_id', 'product_description')->first();
                        $resArray[$loopCount]['productId'] = $productDetails->productId;
                        $resArray[$loopCount]['productName'] = $productDetails->product_name;
                        $resArray[$loopCount]['productAvailableCount'] =  Helper::getItemInventory($productDetails->productId);
                        $resArray[$loopCount]['productCost'] = $productTotalCost= $productDetails->product_cost;
                        $resArray[$loopCount]['productCount'] = $productCount;
                        $resArray[$loopCount]['productTotalCost'] = $productTotalCost * $productCount;
                        $resArray[$loopCount]['product_color'] = $productDetails->product_color;
                        $resArray[$loopCount]['productCode'] = $productDetails->productId;
                        $resArray[$loopCount]['productSize'] = $productDetails->product_size;
                        $producImage = '/images/product/'.$productDetails->productImage;
                        $resArray[$loopCount]['productImage'] = asset($producImage);
                        $loopCount++;
                    }
                    
                }
            }
            
        }
        if(isset($productCartArray) && !empty($productCartArray)){
            foreach($productCartArray as $productCartkey=>$productCartval){
                if($newCartStr == ''){
                    $newCartStr = $productCartkey.'-'.$productCartval['count'];
                }else{
                    $newCartStr = $newCartStr.'/'.$productCartkey.'-'.$productCartval['count'];
                }
            }
        }
        

        
        return response()->json(['code' => 200, 'data'=>$resArray, 'newCartStr'=>$newCartStr]);
        
    }

    public function getOrderView(Request $request)
    {          
        $input = $request->all();
        $cartStr = $input['product'];
        $cartArray = explode('/',$cartStr);
        $loopCount = 0;
        $newCartStr = '';
        $resArray = [];
        $orderCost = 0;
        foreach($cartArray as $cartKey=>$cartVal){
            if(!empty($cartVal)){
                $productArray = explode('-',$cartVal);
                $productId = $productArray[0];
                $productCount = $productArray[1];
                $productDetails = Product::where(['products.status'=>1, 'products.id'=>$productId])
                    ->select('product_cost',  'product_name',)->first();
                $resArray[$loopCount]['productName'] = $productDetails->product_name;
                $resArray[$loopCount]['productCost'] = $producCost= $productDetails->product_cost;
                $resArray[$loopCount]['productCount'] = $productCount;
                $resArray[$loopCount]['productCostTotal'] = $productCostTotal = $producCost * $productCount;
                $orderCost = $orderCost+$productCostTotal;
                $loopCount++;
            }
            
            
        }
        return response()->json(['code' => 200, 'data'=>$resArray, 'orderCost'=>$orderCost]);
        
    }

    
    

    public function setStatus(Request $request)
    {          
        $input = $request->all();
         //print_R($input);exit;
        $id = isset($input['id']) ? $input['id'] : '';
        $status = isset($input['status']) ? $input['status'] : '';
        $type = isset($input['type']) ? $input['type'] : '';
         //dd($id);
        if (!empty($type)) {
            switch ($type) {
                case 'categoryStatus':
                    $updateStatus = Category::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'brandStatus':
                    $updateStatus = Brand::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'subCategoryStatus':
                    $updateStatus = SubCategory::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'productStatus':
                    $updateStatus = Product::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'productPrimeStatus':
                    $updateStatus = Product::where(['id' => $id])->update(['is_prime' => $status]);
                    break;

                case 'productImagePrimeStatus':
                    $productImage = ProductImage::where(['id' => $id])->select('product_id')->first();
                    if($productImage->product_id){
                        if($status == 1){
                            $updatePrimeStatus = ProductImage::where(['product_id' => $productImage->product_id])->update(['is_prime' => 0]);
                        
                        }
                        $updateStatus = ProductImage::where(['id' => $id])->update(['is_prime' => $status]);
                    }
                    
                    break;
                case 'productImageStatus':
                    $updateStatus = ProductImage::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'bannerStatus':
                    $updateStatus = Banner::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'orderStatus':
                    $updateStatus = OrderDetail::where(['id' => $id])->update(['status' => $status]);
                    break;

                case 'deliveryStatus':
                    $updateStatus = DeliveryOption::where(['id' => $id])->update(['status' => $status]);
                    break;

                    
                default:
                    $updateStatus = array();
            }
        } else {
            $updateStatus = array();
        }
        
        if (!empty($updateStatus)) {
            return response()->json(['code' => 200]);
            
        }else{
            return response()->json(array('code' => 100, 'message' => 'Some error , Try again'));
        }
    }
    
    
}
