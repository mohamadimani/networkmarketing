<?php
/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/08/2018
 * Time: 10:16 PM
 */

function filter($data)
{
    $data = filter_var($data, FILTER_SANITIZE_URL);
    $data = trim(htmlspecialchars(stripcslashes($data)));
    return $data;
}

define('SITE_URL', 'http://' . filter($_SERVER['HTTP_HOST']) . '/network_marketing/');
//define('SITE_URL', 'http://' . filter($_SERVER['HTTP_HOST']) . '/');

define('zarinpalMerchantID', "****_****_****_****");
//define('callbackURL', 'http://' . filter($_SERVER['HTTP_HOST']) .'/ecomm/pay_veryfy');
define('callbackURL', SITE_URL . '/ecomm/pay_veryfy');
define('zarinpalWebAdress', 'https://www.zarinpal.com/pg/services/WebGate/wsdl');
define('mohlatPay', "604800"); //for a week

$zarinpalErrors = array(
    '-1' => 'اطلاعات ارسال شده ناقص شده است',
    '-2' => 'IP یا مرچنت کد صحیح نیست',
    '-3' => 'سطح تایید پذیرنده کمتر از نقره ای است',
    '-11' => 'درخواست مورد نظر يافت نشد.',
    '-21' => 'هيچ نوع عمليات مالي براي اين تراكنش يافت نشد.',
    '-22' => 'تراكنش نا موفق ميباشد.',
    '-33' => 'رقم تراكنش با رقم پرداخت شده مطابقت ندارد.',
    '-40' => 'اجازه دسترسي به متد مربوطه وجود ندارد.',
    '-54' => 'درخواست مورد نظر آرشيو شده است.',
    '100' => 'عمليات پرداخت با موفقيت انجام شد. ',
    '101' => 'این عمليات پرداخت قبلا  با موفقیت انجام شده است.',
);
define('zarinpalErrors', serialize($zarinpalErrors));




