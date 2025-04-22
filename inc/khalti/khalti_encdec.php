<?php
require_once('khalti_config.php');

function initiate_khalti_payment($data)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => KHALTI_INITIATE_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Key ' . KHALTI_SECRET_KEY,
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        error_log("Khalti Initiate Payment Error: cURL Error - $error_msg");
        return ['error' => true, 'message' => 'cURL Error: ' . $error_msg];
    }

    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_code !== 200) {
        error_log("Khalti Initiate Payment Error: HTTP $http_code - Response: $response");
        return ['error' => true, 'message' => 'HTTP Error: ' . $http_code, 'response' => $response];
    }

    $response_data = json_decode($response, true);
    if (!$response_data) {
        error_log("Khalti Initiate Payment Error: Invalid JSON response - $response");
        return ['error' => true, 'message' => 'Invalid API response'];
    }

    error_log("Khalti Initiate Payment Response: " . print_r($response_data, true));
    return $response_data;
}

function verify_khalti_payment($pidx)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => KHALTI_VERIFY_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Key ' . KHALTI_SECRET_KEY,
            'Content-Type: application/json',
        ),
    ));

    $response = curl_exec($curl);
    
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        error_log("Khalti Verify Payment Error: cURL Error - $error_msg");
        return ['error' => true, 'message' => 'cURL Error: ' . $error_msg];
    }

    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_code !== 200) {
        error_log("Khalti Verify Payment Error: HTTP $http_code - Response: $response");
        return ['error' => true, 'message' => 'HTTP Error: ' . $http_code, 'response' => $response];
    }

    $response_data = json_decode($response, true);
    if (!$response_data) {
        error_log("Khalti Verify Payment Error: Invalid JSON response - $response");
        return ['error' => true, 'message' => 'Invalid API response'];
    }

    error_log("Khalti Verify Payment Response: " . print_r($response_data, true));
    return $response_data;
}
?>