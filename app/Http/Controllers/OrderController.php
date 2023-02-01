<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\OrderProductMapping;
use App\OrderDetail;
use Config;
Use App\Helpers\Helper;
use App\BookedOrderProduct;

class OrderController extends Controller
{
  
    

    public function getOrderDetails(Request $request)
    {
        $input = $request->all();//print_R($input);exit;
        $orderDetail = [];
        if(isset($input['orderData']) && !empty($input['orderData'])){
            $cartStr = $input['orderData'];
            $orderId = 0;
        }else{
            $cartStr = $input['editorderData'];
            //$orderId = trim($input['editOrderId'], "Or-");
            $intOrder = (int) filter_var($input['editOrderId'], FILTER_SANITIZE_NUMBER_INT);
            $orderId = trim($intOrder, "-");
        }
        
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
        if(isset($orderId) && !empty($orderId)){
            $orderDetail = OrderDetail::where(['id'=>$orderId])->first()->toArray();
        }

        return view('order',compact('resArray', 'orderCost', 'cartStr','orderDetail'));


    }

    public function storeOrder(Request $request)
    {
        $input = $request->all();
        $unavailableProduct = [];
        $insertOrderData['arrival_or_departure_date'] = date('Y-m-d', strtotime(str_replace('.', '/', $input['datepicker'])));
        $insertOrderData['estimated_time_departure_or_arrival'] = $input['expectedArrivals'];
        $insertOrderData['flight_no'] = $input['flightNumber'];
        $insertOrderData['is_transict_customer'] = $input['isTransitCust'];
        $insertOrderData['point_of_collection'] = $input['collectionPoint'];
        $insertOrderData['pickup_person'] = $input['pickupPerson'];
        if(isset($input['nomineeName']) && !empty($input['nomineeName'])){
            $insertOrderData['nominee_name'] = $input['nomineeName'];
        }else{
            $insertOrderData['nominee_name'] = '';
        }
        
        $insertOrderData['order_comments'] = $input['orderComments'];
        
        
        if(isset($input['orderId']) && !empty($input['orderId'])){
            $orderId = $input['orderId'];
            $updateOrder = OrderDetail::where(['id'=>$orderId])->update($insertOrderData);

        }else{
            $deleteStatus = false;
            $orderCost = $insertOrderData['order_cost'] = 0;
            $insertOrderData['status'] = 0;
            $createOrder = OrderDetail::create($insertOrderData);
            $orderId = $createOrder->id;
            if($orderId){
                $cartStr = $input['cartStr'];
                $cartArray = explode('/',$cartStr);
                $loopCount = 0;
                $orderProduct = array();
                //$orderId = $orderId;
                
                foreach($cartArray as $cartKey=>$cartVal){
                    if(!empty($cartVal)){
                        $productArray = explode('-',$cartVal);
                        $productId = $productArray[0];
                        $productCount = $productArray[1];
                        $productDetails = Product::where(['products.status'=>1, 'products.id'=>$productId])
                            ->select('product_cost',  'product_name',)->first();
                        $insertOrderProd['order_id'] = $orderId;
                        $insertOrderProd['product_id'] = $productId;
                        $itemAvailable =  Helper::getItemInventory($productId);
                        $processedProduct = Helper::storeBookedProduct($productId, $orderId, $productCount);
                        if($productCount > $itemAvailable){
                            $deleteStatus =true;
                            $unavailableProduct[] = $productId;
                            
                        }
                        $producCost= $insertOrderProd['product_cost'] = $productDetails->product_cost;
                        $insertOrderProd['product_count'] = $productCount;
                        $insertOrderProd['status'] = 1;
                        
                        $productCostTotal = $producCost * $productCount;
                        $orderCost = $orderCost+$productCostTotal;
                        $createOrderProd = OrderProductMapping::create($insertOrderProd);
                    }
                }
                if($orderCost != 0){
                    $updateOrderCost = OrderDetail::where(['id'=>$orderId])->update(['order_cost'=>$orderCost]);
                }else{
                    return redirect('store-orders');
                }
            }
        }
        if(!$deleteStatus){
            $orderDetails = OrderDetail::where(['id'=>$orderId])->first();
            $orderProduct = OrderProductMapping::leftjoin('products', 'products.id', '=', 'order_product_mappings.product_id')->leftjoin('categories', 'categories.id', '=', 'products.product_category_id')
                ->where(['order_product_mappings.order_id'=>$orderId])
                ->select('products.product_name', 'products.product_color', 'products.product_size', 'order_product_mappings.product_cost', 'order_product_mappings.product_count', 'products.id as productId', 'categories.category_name')
                ->get();
            if($orderDetails->point_of_collection === 'Arrivals Duty Free Shop'){
                $orderRequest['orderID'] = 'AOR-'.$orderId;
            }else{
                $orderRequest['orderID'] = 'DOR-'.$orderId;
            }
            $orderRequest['returnURL'] =  Config::get('custom.returnUrl');
            $orderRequest['cancelURL'] =  Config::get('custom.cancelUrl');
            $orderRequest['partnerID'] =  Config::get('custom.partnerId');
            // if(isset($orderCost) && !empty($orderCost)){
            //     $orderRequest['totalMilesRedeem'] = $orderCost;
            // }else{
                $orderRequest['totalMilesRedeem'] = $orderDetails->order_cost;
            // }
            
            $itemArray = [];
            foreach($orderProduct as $productKey=>$product){
                $orderData['product'][$productKey]['product_name'] = $product->product_name;
                $orderData['product'][$productKey]['product_color'] = $product->product_color;
                $orderData['product'][$productKey]['product_size'] = $product->product_size;
                $orderData['product'][$productKey]['product_count'] = $product->product_count;
                $orderData['product'][$productKey]['product_cost'] = $product->product_cost;
                $itemObject['productID'] = $product->productId;
                $itemObject['quantity'] = $product->product_count;
                //$itemObject['productMiles'] = '1500';//$product->product_cost;
                $itemObject['productMiles'] = $product->product_cost * $product->product_count;
                $itemObject['productName'] = $product->product_name;
                $itemObject['category'] = $product->category_name;
                array_push($itemArray,$itemObject);
            }
            $orderRequest['items'] = json_encode($itemArray);
            // print_R($orderRequest);exit;
            $postUrl = Config::get('custom.storeUrl');
            $orderData['order_comments'] = $orderDetails->order_comments;
            return view('thank-you', compact('orderDetails', 'orderData', 'orderRequest', 'postUrl'));
                
        }else{
            $deleteOrder = OrderDetail::where(['id'=>$orderId])->delete();
            $deleteOrderProduct = OrderProductMapping::where(['order_id'=>$orderId])->delete();
            $deleteProcessOrderProduct = BookedOrderProduct::where(['order_id'=>$orderId])->delete();
            $productStr = '';
            if(isset($unavailableProduct) && !empty($unavailableProduct)){
                foreach($unavailableProduct as $unavailableKey=>$productId ){
                    if($productStr === ''){
                        $productStr = $productId;
                    }else{
                        $productStr = $productStr.'-'.$productId;
                    }
                }
            }
            
            return redirect('cart?order=false&productStr='.$productStr);
        }
        
        
    
    
    }
    
    

}
