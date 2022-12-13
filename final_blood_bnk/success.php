<?php
session_start();
$style = "brands.css";
$page_name = "بنك الدم المصري";
require "./init.php";
require_once 'config.php';
// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));

    $response = $transaction->send();

    if ($response->isSuccessful()) {

        $arr_body = $response->getData();
        // echo "<pre>"; print_r($arr_body);
        // echo $arr_body['payer']['payer_info']['payer_id'];
        $dataintre = [];
        $dataintre[] = NULL;
        $dataintre[] = $arr_body['id']; // PAYID
        $dataintre[] = 500; // User ID 
        $dataintre[] = $arr_body['payer']['payer_info']['payer_id']; //payer_id
        $dataintre[] = $arr_body['payer']['payer_info']['email']; //    payer_email
        $dataintre[] = $arr_body['payer']['payer_info']['first_name']; // payer_first_name
        $dataintre[] = $arr_body['payer']['payer_info']['last_name']; //  payer_last_name
        $dataintre[] = $arr_body['transactions'][0]['amount']['total']; // amount
        $dataintre[] = PAYPAL_CURRENCY; //currency
        $dataintre[] = $arr_body['state']; // payment_status
?>
    <img src="img/success_payment.gif" alt="payment_done" style="padding-top: 70px;width: 50%;display:block;margin:auto">
    <h3 class="text-center" style="font-family: 'Cairo', sans-serif !important;">تمت عملية الدفع بنجاح ... شكرا لك</h3>
    <p class="text-center">. سيعاد توجيهك الأن خلال 7 ثواني <span style="color:#00ff4c"><?php echo $arr_body['id'];?></span> : رقم العمليه</p>
<?php

        // echo "the Payment number is :- " . $arr_body['id']  . "<br>";
        // echo "the Payment state is :- " . $arr_body['state'] . "<br>";
        // echo "the user id is :- " . $arr_body['payer']['payer_info']['payer_id'] . "<br>";
        // echo "the user name is :- " . $arr_body['payer']['payer_info']['first_name'] . "<br>";
        // echo "the user id is :- " . $arr_body['payer']['payer_info']['payer_id'] . "<br>";
        // echo "the amount is :- " .  $arr_body['transactions'][0]['amount']['total'] . "<br>";
        // echo "the amount is :- " . serialize($arr_body['payer']['payer_info']['shipping_address']) . "<br>";

        global $con;
        $stmt = $con->prepare("INSERT INTO payments(payment_id,payment_state,Payment_User_Id,payer_id,amount)
        Value(:payment_id,:payment_state,:Payment_User_Id,:payer_id,:amount)");
        $stmt->execute(
        array(
            ":payment_id"     => $arr_body['id'],
            ":payment_state"     => $arr_body['state'],
            ":Payment_User_Id"    => $arr_body['payer']['payer_info']['payer_id'],
            ":payer_id" =>  3009072355125,
            ":amount" => $arr_body['transactions'][0]['amount']['total'],
        ));
        header("Refresh:7;url=Donate_Money.php");
        
    } else {
        echo $response->getMessage();

    }
} else {

    echo 'Transaction is declined';
}