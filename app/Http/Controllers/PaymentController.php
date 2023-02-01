<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\OrderProductMapping;
use App\OrderDetail;
use App\Payment;
use App\Mail\OrderMail;
use Mail;
Use App\Helpers\Helper;
use App\BookedOrderProduct;


class PaymentController extends Controller
{
  
    
    public function storePayment(Request $request)
    {
        $input = $request->all();
        $intOrder = (int) filter_var($input['orderID'], FILTER_SANITIZE_NUMBER_INT);
        $orderId = trim($intOrder, "-");
        $payment['response'] = json_encode($input);
    
        $response['orderId'] = $payment['orderId'] = $orderId;
        $updateOrderStatus = 0;
        if(isset($input['status']) && $input['status'] == 400){
            $response['orderStatus'] = $payment['orderStatus'] = 'Failed';
            $updateOrderStatus = 0;
        }else{
            $response['orderStatus'] = $payment['orderStatus'] = $input['orderStatus'];
            if(isset($input['orderStatus']) && $input['orderStatus'] == 'SUCCESS'){
                $updateOrderStatus = 4;
            }else{
                $updateOrderStatus = 0;
            }
            
        }
        $createPayment = Payment::create($payment);
        if (isset($input['memberName'])) {
            $memberName= $input['memberName'];
        }
        else{
            $memberName = ""; 
        }

        if (isset($input['sindbadNumber'])) {
            $memberNumber= $input['sindbadNumber'];
        }
        else{
            $memberNumber = ""; 
        }
        if (isset($input['email'])) {
            $client_email = $input['email'];
            
        } else {
            $client_email = "";
           
        }
        $updateOrder = OrderDetail::where(['id'=>$orderId])->update(['orderStatus'=>$payment['orderStatus'], 'client_email'=>$client_email, 'client_name' => $memberName, 'status'=>$updateOrderStatus, 'client_number'=>$memberNumber]);
        $orderDetails = OrderProductMapping::where(['order_id'=>$orderId])->select('product_id', 'product_cost', 'product_count')->get();
        $order = OrderDetail::where(['id'=>$orderId])->first();
        $updateOrder = BookedOrderProduct::where(['order_id'=>$orderId])->update(['status'=>1]);
        if($client_email === ''){
             $emails = [];
            $this->sendOrderMail('mukesh@experiences.digital', $orderId, $emails);
        }else{
            $emails = ['Jayarajan.Mangottil@gsa.omanair.com', 'buthaina.alriyami@omanair.com','niyaz.albalushi@omanair.com', 'customerserviceteam@muscatdutyfree.com', 'mukesh@experiences.digital'];
            $this->sendOrderMail($client_email, $orderId, $emails);
        }
        // print_r($input);
        // exit;
        if($input['orderStatus'] === 'CANCEL'){
           
        // if($payment['orderStatus'] == 'CANCEL'){ 
            $encOrderId = Helper::skill_crypt($orderId, 'e');
            return redirect('/cart');
        }else{
            
            if($client_email === ''){
                $emails = [];
                $this->sendordermail('mukesh@experiences.digital', $orderId, $emails);
            }else{
                $emails = ['jayarajan.mangottil@gsa.omanair.com', 'buthaina.alriyami@omanair.com','niyaz.albalushi@omanair.com', 'customerserviceteam@muscatdutyfree.com', 'mukesh@experiences.digital'];
                $this->sendOrderMail($client_email, $orderId, $emails);
            }
            return view('payment-response', compact('response', 'orderDetails', 'order'));
        }
        // print_R($payment);exit;
        // if($payment['orderStatus'] == 'CANCEL'){
        //     $encOrderId = Helper::skill_crypt($orderId, 'e');
        //     return redirect('/cart');
        
        // }else{
        //     return view('payment-response', compact('response', 'orderDetails', 'order'));
        // }
        
    }

    public function sendOrderMail($clientEmail, $orderId, $bccEmail)
    {          
        //$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
        try{
            if(isset($clientEmail) && !empty($clientEmail)){
                 $order = OrderDetail::where(['id'=>$orderId])->first()->toArray();
                 if($order['orderStatus'] != 'CANCEL'){
                    $orderProduct = OrderProductMapping::leftjoin('products', 'products.id', '=', 'order_product_mappings.product_id')
                    ->where(['order_product_mappings.order_id'=>$orderId])
                    ->select('products.product_name', 'products.product_color', 'products.product_size', 'order_product_mappings.product_cost', 'order_product_mappings.product_count', 'products.id as productId', 'products.product_size')
                    ->get()->toArray();
                    $orderData = $order;
                    $orderData['product'] = $orderProduct;
                    if(Mail::to($clientEmail)->bcc($bccEmail)->send(new OrderMail($orderData))){
                        return true;
                    }else{
                        return false;
                    }
                 }
                
            }else{
                return false;
            }
           
        }catch(Exception $e) {
         return false;
        }
        
        


    }
        
    
}
