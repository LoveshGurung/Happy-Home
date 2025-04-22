<?php
// Khalti Sandbox Configuration
define('KHALTI_ENVIRONMENT', 'TEST'); // Set to 'PROD' for live environment
define('KHALTI_INITIATE_URL', 'https://a.khalti.com/api/v2/epayment/initiate/'); // Sandbox initiation URL
define('KHALTI_VERIFY_URL', 'https://a.khalti.com/api/v2/epayment/lookup/'); // Sandbox verification URL
define('KHALTI_PUBLIC_KEY', 'd5d5cdbebb124bd69eaa96482b00d802'); // Replace with your sandbox public key
define('KHALTI_SECRET_KEY', '436a8dff2c71474290411c0a4c19103e'); // Replace with your sandbox secret key
define('KHALTI_RETURN_URL', 'http://localhost/hbwebsite/pay_response.php'); // Callback URL
define('KHALTI_WEBSITE_URL', 'http://localhost/hbwebsite'); // Your website URL

if (KHALTI_ENVIRONMENT == 'PROD') {
    define('KHALTI_INITIATE_URL', 'https://khalti.com/api/v2/epayment/initiate/'); // Live initiation URL
    define('KHALTI_VERIFY_URL', 'https://khalti.com/api/v2/epayment/lookup/'); // Live verification URL
    // Update with live public and secret keys in production
}
?>