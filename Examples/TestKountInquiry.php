<?php

require "../kountClasses.php";


/************************ Request Variables ***************************/

$store_id=$argv[1];
$api_token=$argv[2];


/********************* Transactional Variables ************************/

$type='kount_inquiry';
$kount_merchant_id=$argv[3];
$kount_api_key=$argv[4];
$order_id=$argv[5];
$call_center_ind=$argv[6];
$currency=$argv[7];
$email=$argv[8];
$auto_number_id=$argv[9];
$payment_token=$argv[10];
$payment_type=$argv[11];
$ip_address=$argv[12];
$session_id=$argv[13];
$website_id=$argv[14];
$amount=$argv[15];
//all the optional fields: 'data_key','customer_id', 'financial_order_id','payment_response',
//'avs_response','cvd_response','bill_street_1','bill_street_2','bill_country','bill_city','bill_postal_code','bill_phone',
//'bill_province','dob','epoc','gender','last4','customer_name','ship_street_1', 'ship_street_2', 'ship_country', 'ship_city', 'ship_email', 
//'ship_name', 'ship_postal_code', 'ship_phone', 'ship_province', 'ship_type','prod_type_n','prod_item_n','prod_desc_n','prod_quant_n','prod_price_n', 'udf'
//let's put some
$avs_response=$argv[16];
$cvd_response=$argv[17];
$prod_type_1=$argv[18];
$prod_item_1=$argv[19];
$prod_desc_1=$argv[20];
$prod_quant_1=$argv[21];
$prod_price_1=$argv[22];

/***************** Transactional Associative Array ********************/

$txnArray=array	(
			'type'=>$type,
       			'kount_merchant_id'=>$kount_merchant_id,
       			'kount_api_key'=>$kount_api_key,
       			'order_id'=>$order_id,
       			'call_center_ind'=>$call_center_ind,
       			'currency'=>$currency,
       			'email'=>$email,
       			'auto_number_id'=>$auto_number_id,
       			'payment_token'=>$payment_token,
       			'payment_type'=>$payment_type,
       			'ip_address'=>$ip_address,
       			'session_id'=>$session_id,
       			'website_id'=>$website_id,
       			'amount'=>$amount,
       			'avs_response'=>$avs_response,
       			'cvd_response'=>$cvd_response,
       			'prod_type_1'=>$prod_type_1,
       			'prod_item_1'=>$prod_item_1,
       			'prod_desc_1'=>$prod_desc_1,
       			'prod_quant_1'=>$prod_quant_1,
       			'prod_price_1'=>$prod_price_1
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

