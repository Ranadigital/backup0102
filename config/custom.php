<?php

if(env('APP_ENV') != 'local'){
    return array(
      'storeUrl' => 'https://sindbad.omanair.com/SindbadProd/store',
      'returnUrl' => env('APP_URL').'/payment',
      'cancelUrl' => env('APP_URL').'/payment',
      'partnerId' => 'ffpmdfprod'
    );
}else{
    return array(
      'storeUrl' => 'https://sindbad-test.omanair.com/sindbadProd/store',
      'returnUrl' => env('APP_URL').'/payment',
      'cancelUrl' => env('APP_URL').'/payment',
      'partnerId' => 'ffpmdftest'
    );
}
