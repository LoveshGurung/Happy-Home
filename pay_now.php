<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('inc/khalti/khalti_config.php');
require('inc/khalti/khalti_encdec.php');

date_default_timezone_set("Asia/Kathmandu");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['pay_now'])) {
    // Prevent caching
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");

    // Validate session data
    if (!isset($_SESSION['room']['payment']) || !isset($_SESSION['room']['id']) || !isset($_SESSION['room']['name'])) {
        echo "<script>alert('Room data missing! Please try again.');</script>";
        redirect('index.php');
    }

    // Filter form data
    $frm_data = filteration($_POST);

    // Validate check-in and check-out dates
    if (!isset($frm_data['checkin']) || !isset($frm_data['checkout']) || !strtotime($frm_data['checkin']) || !strtotime($frm_data['checkout']) || strtotime($frm_data['checkin']) >= strtotime($frm_data['checkout'])) {
        echo "<script>alert('Invalid check-in or check-out dates!');</script>";
        redirect('index.php');
    }

    // Generate unique order ID
    $ORDER_ID = 'ORD_' . $_SESSION['uId'] . random_int(11111, 9999999);
    $_SESSION['khalti_order'] = $ORDER_ID;
    $CUST_ID = $_SESSION['uId'];
    $TXN_AMOUNT = $_SESSION['room']['payment'];

    // Prepare Khalti post data
    $postData = [
        "return_url" => KHALTI_RETURN_URL,
        "website_url" => KHALTI_WEBSITE_URL,
        "amount" => $TXN_AMOUNT * 100, // Convert to paisa
        "purchase_order_id" => $ORDER_ID,
        "purchase_order_name" => $_SESSION['room']['name'],
        "customer_info" => [
            "name" => $frm_data['name'] ?: 'Test User',
            "email" => $frm_data['email'] ?: 'test@example.com',
            "phone" => $frm_data['phonenum'] ?: '9800000000'
        ]
    ];

    // Log the data for debugging
    error_log("Khalti Post Data: " . print_r($postData, true));

    // Insert booking data into database
    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`, `booking_status`) VALUES (?,?,?,?,?,?)";
    insert($query1, [$CUST_ID, $_SESSION['room']['id'], $frm_data['checkin'], $frm_data['checkout'], $ORDER_ID, 'pending'], 'isssss');

    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
    insert($query2, [$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $TXN_AMOUNT, $frm_data['name'], $frm_data['phonenum'], $frm_data['address']], 'issssss');

    // Send request to Khalti API
    $response = initiate_khalti_payment($postData);

    // Log the response
    error_log("Khalti Response: " . print_r($response, true));

    // Check response and redirect
    if (isset($response['error']) && $response['error']) {
        $error_message = $response['message'];
        if (isset($response['response'])) {
            $error_message .= ' - ' . $response['response'];
        }
        echo "<script>alert('Failed to initiate payment! Error: $error_message');</script>";
        redirect('index.php');
    } elseif (isset($response['payment_url'])) {
        header("Location: " . $response['payment_url']);
        exit;
    } else {
        echo "<script>alert('Failed to initiate payment! Unknown error.');</script>";
        redirect('index.php');
    }
}
?>
<html>
<head>
    <title>Processing</title>
</head>
<body>
    <h1>Please do not refresh this page...</h1>
</body>
</html>