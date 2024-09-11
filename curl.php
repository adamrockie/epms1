<?php


$bank = $_POST['bank']; //044
$account = $_POST['account_number']; //0693304975

//$bank = '044';
//$account = '0693304975';


$service_url        = 'https://api.paystack.co/bank/resolve?account_number='.$account.'&bank_code='.$bank;
$access_token       = 'sk_test_b6bd7347061dd7ad4088e2fd3ccd4511d8686fd3';

//Bearer sk_live_6c30c925cee99f76a3e49ed624e9933ab9f708ba

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $service_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer ".$access_token
));

$output = curl_exec($ch);

if($output === FALSE) {
    echo "cURL Error: " . curl_error($ch);
}

$response = json_decode($output);

curl_close($ch);

//var_dump($response);

/*
echo "<br>";
echo $response->message;
echo "<br>";
echo $response->data->reference;


echo "<br>";
echo $response->data->amount;
echo "<br>";
echo $response->data->paid_at;
echo "<br>";
echo $response->data->created_at;
echo "<br>";
echo $response->data->channel;
echo "<br>";
echo $response->data->ip_address;
echo "<br>";
echo "Mobile Number: ". $response->data->metadata->custom_fields[0]->value;
echo "<br>";
echo "Firm Name: ". $response->data->metadata->custom_fields[1]->value;
echo "<br>";
echo "CAC Number: ". $response->data->metadata->custom_fields[2]->value;
*/
/*
$cac_number        =   $response->data->metadata->custom_fields[2]->value;
$rrr               =   $response->data->reference;
$amountz           =   $response->data->amount;
$date_created      =   $response->data->created_at;
$payment_date      =   $response->data->paid_at;
$payment_status    =   $response->message;
$payment_channel   =   $response->data->channel;

$amount = $amountz/100;

$sql ="INSERT INTO payments (cac_number, rrr, amount, date_created, payment_date, payment_status, payment_channel) VALUES ('$cac_number', '$rrr', '$amount', '$date_created', '$payment_date', '$payment_status', '$payment_channel')";

if ($conn->query($sql) === TRUE) {
   return true;
}
else 
{
    return false;
}
*/





?>