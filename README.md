# Paytm Payment Library For Laravel 5 

## Introduction

It simplifies the payment flow with the defined methods. You can pay through paytm just writing few lines of codes. Before you start installing this service, please complete your Paytem setup at [on Paytm](http://paywithpaytm.com).

## Installation

First, you'll need to require the package with Composer:
```sh
composer require princealikhan/paytm-payment
```
Aftwards, run `composer update` from your command line.

Then, update `config/app.php` by adding an entry for the service provider.

```php
'providers' => [
	// ...
	'Princealikhan\PaytmPayment\PaytmServiceProvider',
];
```


Then, register class alias by adding an entry in aliases section

```php
'aliases' => [
	// ...
	'Paytm' => 'Princealikhan\PaytmPayment\Facades\Paytm',
];
```

Finally, from the command line again, run `php artisan vendor:publish` to publish the default configuration file. 
This will publish a configuration file named `paytm.php` which includes your Paytm authorization keys and aditional settings.

## Configuration

You need to fill in `paytm.php` file that is found in your applications `config` directory.
## Usage

### Request for Payment

You can easily send a message to all registered users with the command
```php
$request = array('CUST_ID' => 1 ,'TXN_AMOUNT'=> 1 );
Paytm::pay($request);
```   
`CUST_ID` and `TXN_AMOUNT` fields value are pass to Paytm and redirect to callback URL.

### After redirect to callback URL 
Once we redirected to callback URL we need to verify whether transaction `Success` or `Fail`.
#### Example 
Suppose, your callback URL is `https://your-app.io/payment/callback` 
Paytm `POST` respone on your URL.
we need to get response.

In `routes.php` add a post method.
```php
Route::post("payment/callback", "PaymentController@callback");
```

In `PaymentController` create a method 

```php
public function callback(Request $Request)
{
$paymentResponse =  $Request->all();
$paymentData     = Paytm::verifyPayment($paymentResponse);
}
```
`$postData` gives transcation details.
after, use your business logic to save.

    
### Check Transaction Status

```php
Paytm::transactionStatus($orderID);
```   
`$orderID` is the Unique ID generated for the transaction by merchant    

### Initiate Refund Process

```php
Paytm::initiateTransactionRefund($orderID,$amount,$txnType);
```   
`$orderID`: Transaction Order Id by merchant.

`$amount`: Amount to refund. 

`$txnType`; Any one of below values: `REFUND` `CANCEL`

Please refer to [Documentation](http://paywithpaytm.com/developer/paytm_api_doc).
for all customizable parameters.


