<?php
namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    public function paymentStatus(){
        return view('paymentStatus');
    }
    public function payWithpaypal($id)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = OrderItem::where('orderID',$id)->get();
        $item_list = new ItemList();
        $total = 0;
        foreach ($items as $item){
            $_item = new Item();
            $_item->setName($item->item->name) /** item name **/
            ->setCurrency('USD')
                ->setQuantity($item->quantity)
                ->setPrice($item->item->price); /** unit price **/
                $item_list->addItem($_item);
                $total = $total + ($item->quantity * $item->item->price);
        }

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
        ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('paymentStatus');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('paymentStatus');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('paymentStatus');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('paymentStatus');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $date = new DateTime();
            $orders = Order::where('userID',Auth::user()->id)->whereNull('orderDate')->get();
            $activeOrder = $orders[0];
            $activeOrder->orderDate = $date->format('Y-m-d');
            $items = OrderItem::where('orderID',$activeOrder->id)->get();
            foreach ($items as $item){
                $activeOrder->total = $activeOrder->total + ($item->item->price * $item->quantity);
            }
            $activeOrder->save();
            \Session::put('success', 'Payment success');
            return Redirect::to('paymentStatus');
        }

        \Session::put('error', 'Payment failed');
        return Redirect::to('paymentStatus');

    }

}
