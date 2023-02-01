<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderMail;
use Mail;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    private $orderData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderData)
    {
         $this->orderData=$orderData;
         if(isset($orderData['updateStatus']) && !empty($orderData['updateStatus'])){
            $this->subject='Order Update';
         }else{
            $this->subject='Sindbad Order';
         }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        $orderInfo = $this->orderData;
        if($orderInfo){

        }else{

        }
        return $this->from('noreply@muscatdutyfree.com')
               ->subject($this->subject)
               ->view('emails.order',["orderData"=>$this->orderData,"title"=>"Sindbad Order"]);
    }
}
