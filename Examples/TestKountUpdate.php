<?php

require "../kountClasses.php";


/************************ Request Variables ***************************/

$store_id=$argv[1];
$api_token=$argv[2];


/********************* Transactional Variables ************************/

$type='kount_update';
$kount_merchant_id=$argv[3];
$kount_api_key=$argv[4];
$order_id=$argv[5];
$session_id=$argv[6];
$kount_transaction_id=$argv[7];
//all the optional fields:'evaluate', 'refund_status', 'avs_response', 'cvd_response','payment_response','last4', 'financial_order_id', 'payment_token', 'payment_type'
//let's put some
$avs_response=$argv[8];
$cvd_response=$argv[9];

/***************** Transactional Associative Array ********************/

$txnArray=array	(
			'type'=>$type,
       			'kount_merchant_id'=>$kount_merchant_id,
       			'kount_api_key'=>$kount_api_key,
       			'order_id'=>$order_id,
       			'session_id'=>$session_id,
       			'kount_transaction_id'=>$kount_transaction_id,
       			'avs_response'=>$avs_response,
       			'cvd_response'=>$cvd_response
          	);

/********************** Transaction Object ****************************/

$kountTxn = new kountTransaction($txnArray);

/************************ Request Object ******************************/

$kountRequest = new kountRequest($kountTxn);

/*********************** HTTPS Post Object ****************************/

$kountHttpsPost  =new kountHttpsPost($store_id,$api_token,$kountRequest);

/***************************** Response ******************************/

$kountResponse=$kountHttpsPost->getkountResponse();

print("\nResponseCode = " . $kountResponse->getResponseCode());
print("\nReceiptId = " . $kountResponse->getReceiptId());
print("\nMessage = " . $kountResponse->getMessage());
print("\nKountResult = " . $kountResponse->getKountResult());
print("\nKountScore = " . $kountResponse->getKountScore());

$kountInfo = $kountResponse->getKountInfo();

foreach($kountInfo as $key => $value)
{
	print("\n".$key ." = ". $value);
}

?>

