<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Paystack;
use App\Payment;

class PaymentController extends Controller
{
    public $paystack;

    public function __construct()
    {
        $this->paystack = new Paystack();
    }

    //
    public function redirectToGateway(Request $request)
    {

        $email = Payment::where('email', $request->email)->first();
        if(isset($email))
        {
            return redirect()->to('register')->with('status', 1)->with('email', $email->email)->with('message', 'Please Continue Your Registration');
        }
        //dd($request);
        $request->metadata = json_encode($array = [
            "email" => $request->email,
        ]);
        $request->email = $request->email;
        $request->amount = '100000';
        $request->reference = $this->paystack->genTranxRef();
        $request->key = config('paystack.secretKey');

        try {
            //code...
            return $this->paystack->getAuthorizationUrl()->redirectNow();

        } catch (\Exception $e) {
            //throw $th;
            return back()->with('failure', 'Opps!!! Something went wrong please check your internet connection');
        }
        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = $this->paystack->getPaymentData();

        //dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
        $transaction_ref = false;
        if($paymentDetails['status'])
        {
            Payment::create([
                "email" => $paymentDetails["data"]["customer"]["email"],
                "transaction_ref" => $paymentDetails["data"]["reference"],
                "amount" => $paymentDetails["data"]["amount"]/100
            ]);
            

            return redirect()
            ->to('register')
            ->with('status', $paymentDetails['status'])
            ->with('email', $paymentDetails["data"]["customer"]["email"])
            ->with('message', 'Payment Successful, Please Continue Your Registration');
        }
        

        return redirect()->to('register')->with('transaction_ref');
        
    }

    public function index()
    {
        $links = [
            "title" => "Payments",
            "sub_title" => "Index"
        ];
        
        $payments = Payment::all();

        return view('payment.index', compact('links', 'payments'));
    }
}
