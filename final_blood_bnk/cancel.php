<?php
session_start();
$style = "brands.css";
$page_name = "بنك الدم المصري";
require "./init.php";
require_once 'config.php';
?>
<img src="img/error_payment.gif" alt="payment_done" style="padding-top: 70px;width: 50%;display:block;margin:auto">
<h3 class="text-center mt-4 mb-4" style="font-family: 'Cairo', sans-serif !important;color:#f00">خطأ في عملية الدفع</h3>
<p class="text-center">من فضلك تاكد من صحة البيانات المدخله ..... سيتم اعادة توجيهك الأن بعد 7 ثواني .</p>


<?php
        header("Refresh:7;url=Donate_Money.php");