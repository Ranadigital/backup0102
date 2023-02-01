<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use App\Product;
use App\OrderProductMapping;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;
use App\BookedOrderProduct;
use Carbon\Carbon;
use App\LogDetail;
use Auth;

class Helper
{
   

    public static function skill_crypt($string, $action = 'e')
    {
        // you may change these values to your own
        $secret_key = 'sbecom';
        $secret_iv = 'staycreative';

        $output = false;
        $encrypt_method = 'AES-256-CBC';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'e') {
            $output = base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
        } elseif ($action == 'd') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public static function getProductName($productId){
        $product = Product::where(['id'=>$productId])->select('product_name')->first();
        if($product){
            return $product->product_name;
        }else{
            return 'NA';
        }
    }

    public static function getOrderDetails($orderId){
        $orderProducts = OrderProductMapping::where(['order_id'=>$orderId])->get();
        if($orderProducts){
            return $orderProducts;
        }else{
            return false;
        }
    }

    public static function storeBookedProduct($productId,  $orderId, $productCount){
        $stroeprodCount = BookedOrderProduct::create(['product_id'=>$productId, 'order_id'=>$orderId, 'count'=>$productCount, 'status'=>0]);
        return true;

    }

    public static function storeLogs($oldData,  $newData, $action, $module){
        $user = Auth::user();
        $userId = $user->id;
        $userEmail = $user->email;
        $stroeprodCount = LogDetail::create(['old_data'=>json_encode($oldData), 'new_data'=>json_encode($newData), 'action'=>$action, 'status'=>1, 'module'=>$module, 'user_email'=>$userEmail, 'user_id'=>$userId]);
        return true;

    }


    public static function getItemInventory($productId){

        try {
            $client = new Client();
            //$response = $client->get('http://localhost:4055/health');
            $comapneyName = 'Muscat%20Duty%20Free';
            $formatFilterStr = 'Inventory?$format=json&$filter=';
            $getUrl = "http://172.16.1.252:7048/DynamicsNAV90/OData/Company('".$comapneyName."')/".$formatFilterStr."Item_No eq '".$productId."'";//'".$productId."'";
            $response =  $client->request('GET', $getUrl, [
                'auth' => ['mdfadminraja', 'Access@789789', 'ntlm']
            ]);
            if($response->getStatusCode() === 200){
                $responsebody =  json_decode($response->getBody()->getContents());
                
                $productDetails = $responsebody->value;
                $formatStartDate = new Carbon();
                $releaseTimer =  date('Y-m-d H:i:s',strtotime('-15 minutes',strtotime($formatStartDate)));
                $releaseOrder = BookedOrderProduct::where('created_at', '<', $releaseTimer)->where(['status'=>0])->delete();
                $todaysOrder = BookedOrderProduct::whereBetween('created_at',[$formatStartDate->format('Y-m-d')." 00:00:00", $formatStartDate->format('Y-m-d')." 23:59:59"])->where(['product_id'=>$productId])->sum('count');  
                if(isset($productDetails[0]->Buffer_Stock) && !empty($productDetails[0]->Buffer_Stock)){
                    return  $productDetails[0]->Buffer_Stock - $todaysOrder;
                }else{
                    return  0;
                }
                
            }else{
                return 0;
            }
           
        }
        catch (exception $e) {
            return 0;
        }
        // finally {
        //     return 4;
            
            
        // }
        
    }


    
    
}
