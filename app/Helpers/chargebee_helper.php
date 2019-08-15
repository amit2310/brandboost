<?php

function initCbConfiguration() {
    try {
        $file = 'chargebee-php/lib/ChargeBee.php';
        if (file_exists($file)) {
            require_once($file);
            $cbSite = config('bbconfig.cb_site_name');
            $cbSiteToken = config('bbconfig.cb_access_token');
            ChargeBee_Environment::configure($cbSite, $cbSiteToken);
            return true;
        }
        return false;
    } catch (Exception $ex) {
        return false;
    }
}

function cbTest() {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        $aInputBilling = array(
            'firstName' => 'Mr',
            'lastName' => 'Dean3',
            'line1' => 'Avantika',
            'city' => 'Delhi',
            'state' => 'Delhi',
            'zip' => '110085',
            'country' => 'India'
        );

        $aInput = array(
            'firstName' => 'Mr',
            'lastName' => 'Dean3',
            'email' => 'faketo@gmail.com',
            'phone' => '9654365662',
                //'billingAddress' => $aInputBilling
        );


        $aResponse = ChargeBee_Customer::create($aInput);

        //$oRes = $aResponse->customer();
        pre($aResponse);
        echo "All done";
    }else{
        die('Something went wrong');
    }    
}

?>