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
use App\OrderProductMapping;
use App\OrderDetail;
use App\Mail\OrderMail;
use Mail;
Use App\Helpers\Helper;
use Carbon\Carbon;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (!Gate::allows('order_manage')) {
            return abort(401);
        }
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $btnStatus = ($type != '') ? $type : '';
        if($type ){
            $orders = OrderDetail::orderBy('id')->where(['status'=>$type])->get();
        }else{
            $orders = OrderDetail::orderBy('id')->where(['orderStatus'=>'SUCCESS'])->get();    
        }
        
        
        return view('admin.order.index',compact('orders',  'type', 'btnStatus'));
    }

    public function getProductString($orderId){
        if (!Gate::allows('order_manage')) {
            return abort(401);
        }
        $orderProducts = Helper::getOrderDetails($orderId);
        $prodStr = '';
        if(isset($orderProducts) && !empty($orderProducts) && count($orderProducts) > 0){
            foreach($orderProducts as $productKey=>$product){
                $productName = Helper::getProductName($product->product_id);
                if($prodStr == ''){
                    $prodStr = $product->product_count.'- '.$productName;
                }else{
                    $prodStr = $prodStr.'/ '.$product->product_count.'- '.$productName;
                }
            }
        }
        return $prodStr;
    }

    public function downloadOrderCsv(Request $request)
    {
        if (!Gate::allows('order_manage')) {
            return abort(401);
        }
        $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
        $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

        if($startDate != '' && $endDate != ''){
            $formatStartDate = new Carbon($startDate);
            $formatEndDate = new Carbon($endDate);
            
            $orders = OrderDetail::whereBetween('created_at',[$formatStartDate->format('Y-m-d')." 00:00:00", $formatEndDate->format('Y-m-d')." 23:59:59"])->get()->toArray();
            if(count($orders) > 0 ){
                $filename = 'SBorder-'.$startDate.'-'.$endDate.'.csv';
                $handle = fopen($filename, 'w+');
                fputcsv($handle, array('Order No', 'Client Email', 'Client Name', 'Client Number', 'Arrival/Departure',  'Flight No', 'Point Of Collection', 'Pickup Person', 'Order Cost', 'Payment Status',  'Order Status', 'Product Dateils', 'Created At', 'Order Comments'));

                foreach($orders as $order) {
                    $orderId = 'Or-'.$order['id'];
                        $arrival = $order['arrival_or_departure_date'].' at'. $order['estimated_time_departure_or_arrival'];
                        
                        if(isset($order['nominee_name']) && !empty($order['nominee_name'])){
                            $pickupName = $order['nominee_name'];
                        }else{
                            $pickupName = 'Self';
                        }
                        
                        if($order['orderStatus'] == 'SUCCESS'){
                            $paymentStatus = 'Payment Success';
                        }elseif($order['orderStatus'] == 'FAILED'){
                            $paymentStatus = 'Payment Success';
                        }elseif($order['orderStatus'] == 'CANCEL'){
                            $paymentStatus = 'Payment Cancel';
                        }elseif(isset($order['orderStatus']) && !empty($order['orderStatus'])){
                            $paymentStatus = $order['orderStatus'];
                        }else{
                            $paymentStatus = 'Pending';
                        }
                        $csvOrder[] = $order['created_at'];
                        if($order['status'] == 0){
                            $orderStatus = 'Pending';
                        }elseif($order['status'] == 1){
                            $orderStatus = 'Customer Delivered';
                        }elseif($order['status'] == 2){
                            $orderStatus = 'Ready For Collection';
                        }elseif($order['status'] == 3){
                            $orderStatus = 'Cancelled By Sindbad';
                        }else{
                            $orderStatus = 'NA';
                        }

                        $productStr = $this->getProductString($order['id']);
                    fputcsv($handle, array($orderId, $order['client_email'], $order['client_name'], $order['client_number'], $arrival, $order['flight_no'], $order['point_of_collection'], $pickupName, $order['order_cost'], $paymentStatus,$orderStatus, $productStr, $order['created_at'], $order['order_comments']));
                }

                fclose($handle);

                $headers = array(
                    'Content-Type' => 'text/csv',
                );
                return response()->download($filename, 'SBorder-'.$startDate.'-'.$endDate.'.csv', $headers);
            }else{
                print_r('No Record Found');exit;
            }
        }else{
            print_r('Please provide valid input');exit;
        }
    }

    public function updateOrderStatus(Request $request)
    {
        if (!Gate::allows('order_manage')) {
            return abort(401);
        }
        $inputData = $request->all();
        $orderId = $inputData['orderId'];
        $orderStatus = $inputData['status'];
        $orderComent = $inputData['orderComent'];
        $oldData = OrderDetail::where(['id' => $orderId])->first()->toArray();
        $updateOrder = OrderDetail::where(['id'=>$orderId])->update(['status'=>$orderStatus, 'comment'=>$orderComent]);
        $newData = OrderDetail::where(['id'=>$orderId])->first()->toArray();
        $action = 'Update';
        $updateLogs = Helper::storeLogs($oldData,  $newData, $action, 'Order');
        if($updateOrder){
            $orderDetails = OrderDetail::where(['id'=>$orderId])->first();
            $client_email = $orderDetails->client_email;
            if(!$client_email){
                $emails = [];
                 $this->sendOrderMail('mukesh@experiences.digital', $orderId, $emails);
                //$this->sendOrderMail('ateevmishra1989@gmail.com', $orderId, $emails);
                
            }else{
                
                $emails = ['Jayarajan.Mangottil@gsa.omanair.com', 'buthaina.alriyami@omanair.com','niyaz.albalushi@omanair.com', 'customerserviceteam@muscatdutyfree.com', 'mukesh@experiences.digital'];
                $this->sendOrderMail($client_email, $orderId, $emails);
                
            }
            return response()->json(['code' => 200, 'msg'=>'Order Status update.']);
        }else{
            return response()->json(['code' => 400, 'msg'=>'Unable to update order status, please try after some time.']); 
        }

    }

    public function sendOrderMail($clientEmail, $orderId, $bccEmail)
    {   
        if (!Gate::allows('order_manage')) {
            return abort(401);
        }       
        //$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : '';
        try{
            if(isset($clientEmail) && !empty($clientEmail)){
                 $order = OrderDetail::where(['id'=>$orderId])->first()->toArray();
                $orderProduct = OrderProductMapping::leftjoin('products', 'products.id', '=', 'order_product_mappings.product_id')
                    ->where(['order_product_mappings.order_id'=>$orderId])
                    ->select('products.product_name', 'products.product_color', 'products.product_size', 'order_product_mappings.product_cost', 'order_product_mappings.product_count', 'products.id as productId', 'products.product_size')
                    ->get()->toArray();
                $orderData = $order;
                $orderData['updateStatus'] = true;
                $orderData['product'] = $orderProduct;
                if(Mail::to($clientEmail)->bcc($bccEmail)->send(new OrderMail($orderData))){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
           
        }catch(Exception $e) {
         return false;
        }
        
        


    }
    public function getOrderData(Request $request)
    {
        if (!Gate::allows('order_manage')) {
            return abort(401);
        }
        $inputData = $request->all();
        if(isset($inputData['orderId']) && !empty($inputData['orderId'])){
            $orderId = $inputData['orderId'];
            $orderData = [];
            $orders = OrderDetail::where(['id'=>$orderId])->first();
            $orderProduct = OrderProductMapping::leftjoin('products', 'products.id', '=', 'order_product_mappings.product_id')
            ->where(['order_product_mappings.order_id'=>$orderId])
            ->select('products.product_name', 'products.product_color', 'products.product_size', 'order_product_mappings.product_cost', 'order_product_mappings.product_count')
            ->get();

            foreach($orderProduct as $productKey=>$product){
                $orderData['product'][$productKey]['product_name'] = $product->product_name;
                $orderData['product'][$productKey]['product_color'] = $product->product_color;
                $orderData['product'][$productKey]['product_size'] = $product->product_size;
                $orderData['product'][$productKey]['product_count'] = $product->product_count;

            }
            $orderData['order_comments'] = $orders->order_comments;
            return response()->json(['code' => 200, 'data'=>$orderData]);
            
        }else{
            return response()->json(['code' => 400, 'msg'=>'Please provide valid input']);
        }
    }

}
