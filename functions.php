<?php

function create_anticipation($recipient_id,$build,$payment_date,$array_payables_ids,$pagarme_api_token){

    $curl = curl_init();
    //$payment_date_convert= (1559811600*1000);

    $array_payables_ids_string = implode(",",$array_payables_ids);    

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pagar.me/1/recipients/".$recipient_id."/bulk_anticipations/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n    \"build\": \" ". $build . " \", \r\n    \"payment_date\": \"".$payment_date."\", \r\n\t\"payables_ids\": [". $array_payables_ids_string ."] \r\n\r\n}",
    CURLOPT_HTTPHEADER => array(
        "Authorization: " . $pagarme_api_token,
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: application/json"    
        )
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    echo $response;
    }
    return $response;

}

function get_transaction_payables($transaction_id){

    $curl = curl_init();
 

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.pagar.me/1/transactions/".$transaction_id."/payables",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    //CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Basic YWtfdGVzdF9PSzVYU3hObFE3WU5sNXpRaEtSRHlGQzkyTVhjZk86eA==",
        "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
    //echo $response;
    }

    return $response;
}

?>
