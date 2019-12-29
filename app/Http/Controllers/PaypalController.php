<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payout;
use App\Job;
use Alert;
use Illuminate\Support\Facades\URL;
// use PayPal\Api\ChargeModel;
// use PayPal\Api\Currency;
// use PayPal\Api\MerchantPreferences;
// use PayPal\Api\PaymentDefinition;
// use PayPal\Api\Plan;
// use PayPal\Api\Patch;
// use PayPal\Api\PatchRequest;
// use PayPal\Common\PayPalModel;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

use PayPal\Api\Amount;
// use PayPal\Api\Details;
// use PayPal\Api\Item;
// use PayPal\Api\ItemList;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaypalController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

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

	public function sendPayout(Request $request)
	{
		$payout = Payout::find($request->payout_id);
		$job = Job::find($payout->job_id);


		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$amount = new Amount();
		$amount->setCurrency("USD")
		    ->setTotal($payout->wage);
		    // ->setDetails($details);

		$payee = new Payee();
		$payee->setEmail("p_a_p_i_l_l_o_n_b_l_e_u-facilitator@yahoo.com");

		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setDescription("Wage for $payout->hours work rendered as $job")
		    ->setPayee($payee)
		    ->setInvoiceNumber(uniqid());

		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("http://wagewave-raym.000webhostapp.com/payout")
		    ->setCancelUrl("http://wagewave-raym.000webhostapp.com/payout");

		$payment = new Payment();
		$payment->setIntent("wage")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));

		$request = clone $payment;

		try {
		    $payment->create($this->_api_context);
		    $approvalURL = $payment->getApprovalLink();
			return redirect($approvalURL);
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
	        var_dump(json_decode($ex->getData()));
	        exit(1);
        }
	}

}
