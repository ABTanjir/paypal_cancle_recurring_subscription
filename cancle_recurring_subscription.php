<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
    'USER' => 'XXXXXXXXXXX',                        //Your API User
    'PWD' => 'XXXXXXXXXXXXX',                       //Your API Password
    'SIGNATURE' => 'XXXXXXXXXXXXXXXXXXXXXXXXXXX',   //Your API Signature
    
    'VERSION' => '108',
    'METHOD' => 'ManageRecurringPaymentsProfileStatus',
    'PROFILEID' => 'I-***********',                 //here add your profile id you should track this while creating subscription
    'ACTION'    => 'Cancel'                         //this can be selected in these default paypal variables (Suspend, Cancel, Reactivate)
)));

$response =    curl_exec($curl);
curl_close($curl);
$nvp = array();

if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
    foreach ($matches['name'] as $offset => $name) {
        $nvp[$name] = urldecode($matches['value'][$offset]);
    }
}

printf("<pre>%s</pre>",print_r($nvp, true));
