<?php

class payment
{


//    public $merchend="77eaacec-43c1-11e9-9459-000c295eb8fc";


    function __construct()
    {
        require('public/nosoap/nusoap.php');
    }

    function zarinpalRequest($Amount = '', $Description = '', $Email = '', $Mobile = '')
    {
        $client = new nusoap_client(zarinpalWebAdress, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $params = array(
            'MerchantID' => zarinpalMerchantID,
            'Amount' => $Amount,
            'Description' => $Description,
            'Email' => $Email,
            'Mobile' => $Mobile,
            'CallbackURL' => callbackURL
        );
        $result = $client->call('PaymentRequest', $params);
        $Status = $result['Status'];
        $ErrorsArray = unserialize(zarinpalErrors);
        $Authority = '';
        $Error = '';
        if ($Status == 100) {
            $Authority = $result['Authority'];
        } else {
            if (!empty($ErrorsArray[$Status]))
                $Error = $ErrorsArray[$Status];
        }
        $array = array('Status' => $Status, 'Authority' => $Authority, 'Error' => $Error);
        return $array;
    }

    function zarinpalVerify($Amount = '', $Authority = '')
    {
        $client = new nusoap_client(zarinpalWebAdress, 'wsdl');
        $client->soap_defencoding = 'UTF-8';
        $result = $client->call('PaymentVerification', array(
            'MerchantID' => zarinpalMerchantID,
            'Amount' => $Amount,
            'Authority' => $Authority
        ));
        $Status = $result['Status'];
        $Error = '';
        $RefID = '';
        $ErrorsArray = unserialize(zarinpalErrors);
        if ($Status == 100) {
            $RefID = $result['RefID'];
        } else {
            if (!empty($ErrorsArray[$Status]))
                $Error = $ErrorsArray[$Status];
        }
        $array = array('Status' => $Status, 'Error' => $Error, 'RefID' => $RefID);
        return $array;
    }

} ?>













