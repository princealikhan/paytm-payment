<?php namespace Princealikhan\PaytmPayment;

use Princealikhan\PaytmPayment\Factories\PaytmFactory;
use Illuminate\Support\Facades\Config;

class Paytm extends PaytmFactory{
	
	function __construct()
	{
		$config = Config::get('paytm');

		$env = $config['default'];

		if($env=='sandbox')
		{
			$this->refund 		= 'https://pguat.paytm.com/oltp/HANDLER_INTERNAL/REFUND';
			$this->txnStatus 	= 'https://pguat.paytm.com/oltp/HANDLER_INTERNAL/TXNSTATUS';
			$this->txnUrl 		= 'https://pguat.paytm.com/oltp-web/processTransaction';

		}else{

			$refund 	= 'https://secure.paytm.in/oltp/HANDLER_INTERNAL/REFUND';
			$txnStatus 	= 'https://secure.paytm.in/oltp/HANDLER_INTERNAL/TXNSTATUS';
			$txnUrl 	= 'https://secure.paytm.in/oltp-web/processTransaction';
		}
		
		$this->orderPrefix = Config::get('paytm.order_prefix');	
		$this->callback    = Config::get('paytm.callback_url');	
		$this->channel 	   = Config::get('paytm.channel');
		$this->industry	   = Config::get('paytm.industry_type');
		$this->website	   = Config::get('paytm.website');
		$this->merchantKey = Config::get('paytm.connections.'.$env.'.merchant_key');
		$this->merchantMid = Config::get('paytm.connections.'.$env.'.merchant_mid');	
	}
	public function getTxnStatus($requestParamList) {
		return parent::callAPI($txnStatus, $requestParamList);
	}

	function initiateTxnRefund($requestParamList) {
	$CHECKSUM = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
	$requestParamList["CHECKSUM"] = $CHECKSUM;
	return self::callAPI(PAYTM_REFUND_URL, $requestParamList);
	}

	public function pay($requestParamList) {

		$requestParamList["MID"]				= $this->merchantMid;
		$requestParamList["ORDER_ID"]			= parent::orderID($this->orderPrefix);
		$requestParamList["INDUSTRY_TYPE_ID"] 	= $this->industry;
		$requestParamList["CHANNEL_ID"] 		= $this->channel;
		$requestParamList["WEBSITE"] 			= $this->website;
		//$requestParamList["CALLBACK_URL"] 		= $this->callback;

		$checkSum = parent::getChecksumFromArray($requestParamList,$this->merchantKey);
		return parent::payNow($this->txnUrl, $requestParamList,$checkSum);
	}

	public function callback()
	{
		return 'Awesome';
		# code...
	}






}