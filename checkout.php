<?php 
require __DIR__ ."/vendor/autoload.php";

$stripe_secret_key="sk_test_51OI7FZKKVGgrJHPUWlFGAFYmqpvPQSETTFPHjMrmJTkfYo2WmVwQcoUzlR0nnQc1ulAno9K2BFRzChbKdhB7zVem00XCQHBxH5";

\Stripe\Stripe::setApikey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost:82/stripe-integration/success.php",
    "cancel_url" => "http://localhost:82/stripe-integration/index.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 2000,
                "product_data" => [
                    "name" => "T-shirt"
                ]
            ]
        ],
        [
            "quantity" => 2,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 700,
                "product_data" => [
                    "name" => "Hat"
                ]
            ]
        ]        
    ]
]);


http_response_code(303);
header("Location:".$checkout_session->url);

?>