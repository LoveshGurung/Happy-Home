<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');
require('inc/khalti/khalti_config.php');
require('inc/khalti/khalti_encdec.php');

date_default_timezone_set("Asia/Kathmandu");

session_start();
unset($_SESSION['room']);

function regenrate_session($uid)
{
    $user_q = select("SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$uid], 'i');
    $user_fetch = mysqli_fetch_assoc($user_q);

    $_SESSION['login'] = true;
    $_SESSION['uId'] = $user_fetch['id'];
    $_SESSION['uName'] = $user_fetch['name'];
    $_SESSION['uPic'] = $user_fetch['profile'];
    $_SESSION['uPhone'] = $user_fetch['phonenum'];
}

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

if (isset($_GET['pidx']) && isset($_SESSION['khalti_order'])) {
    $pidx = filter_input(INPUT_GET, 'pidx', FILTER_SANITIZE_STRING);
    $order_id = $_SESSION['khalti_order'];

    // Verify payment with Khalti API
    $response = verify_khalti_payment($pidx);

    // Log the response
    error_log("Khalti Verification Response: " . print_r($response, true));

    // Check if booking exists
    $slct_query = "SELECT `booking_id`, `user_id` FROM `booking_order` WHERE `order_id`=?";
    $slct_res = select($slct_query, [$order_id], 's');

    if (mysqli_num_rows($slct_res) == 0) {
        redirect('index.php');
    }

    $slct_fetch = mysqli_fetch_assoc($slct_res);

    if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        regenrate_session($slct_fetch['user_id']);
    }

    if (isset($response['error']) && $response['error']) {
        $trans_id = null;
        $trans_amt = 0;
        $trans_status = 'Failed';
        $trans_resp_msg = $response['message'];

        $upd_query = "UPDATE `booking_order` SET `booking_status`='payment failed',
            `trans_id`=?, `trans_amt`=?, `trans_status`=?, `trans_resp_msg`=?
            WHERE `booking_id`=?";
        update($upd_query, [$trans_id, $trans_amt, $trans_status, $trans_resp_msg, $slct_fetch['booking_id']], 'sisss');
        redirect('pay_status.php?order=' . $order_id);
    }

    // Process verification response
    $trans_id = $response['idx'] ?? null;
    $trans_amt = isset($response['total_amount']) ? $response['total_amount'] / 100 : 0; // Convert paisa to NPR
    $trans_status = $response['status'] ?? 'Pending';
    $trans_resp_msg = isset($response['message']) ? $response['message'] : json_encode($response);

    if ($trans_status === 'Completed') {
        $booking_status = 'booked';
    } else {
        $booking_status = 'payment failed';
    }

    // Update booking with transaction details
    $upd_query = "UPDATE `booking_order` SET `booking_status`=?, `trans_id`=?, `trans_amt`=?, `trans_status`=?, `trans_resp_msg`=?
                  WHERE `booking_id`=?";
    update($upd_query, [$booking_status, $trans_id, $trans_amt, $trans_status, $trans_resp_msg, $slct_fetch['booking_id']], 'ssisss');

    // Clear session data
    unset($_SESSION['khalti_order']);

    redirect('pay_status.php?order=' . $order_id);
} else {
    redirect('index.php');
}
?>