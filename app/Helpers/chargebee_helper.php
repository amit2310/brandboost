<?php

/**
 * Initializes Chargeebee connection and includes all necessary files
 * @return boolean
 */
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

/**
 * Used to create chargebee contact
 * @param type $aData
 * @return string
 */
function cbHelperCreateContact($aData) {
    $bConfiguredSuccess = initCbConfiguration();

    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {

            $aResponse = ChargeBee_Customer::create($aData);
            $oRes = $aResponse->customer();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Used to add CC related info at chargebee
 * @param type $cbContactID
 * @param type $aData
 * @return string
 */
function cbHelperAddCC($cbContactID, $aData) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Card::updateCardForCustomer($cbContactID, $aData);
            $oRes = $aResponse->card();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Used to create chargebee subscription
 * @param type $cbContactID
 * @param type $aData
 * @return string
 */
function cbHelperCreateSubscription($cbContactID, $aData) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::createForCustomer($cbContactID, $aData);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Used to charge for a invoice at chargebee
 * @param type $cbContactID
 * @param type $aData
 * @return string
 */
function cbHelperCreateInvoice($aData) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Invoice::create($aData);
            $oRes = $aResponse->invoice();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Used to update Subscription in chargeebee
 * @param type $bbSubscriptionID
 * @param type $aData
 * @return string
 */
function cbHelperUpdateSubscription($cbSubscriptionID, $aData) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::update($cbSubscriptionID, $aData);
            $aInvoice = $aResponse->invoice();
            $oRes = $aResponse->subscription();
            return array($aInvoice, $oRes);
        } catch (Exception $ex) {
            return array('', '');
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Cancel chargebee subscription
 * @param type $cbSubscriptionID
 * @param type $aData
 * @return type
 */
function cbHelperCancelSubscription($cbSubscriptionID) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::cancel($cbSubscriptionID);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}


/**
 * Reactivate chargebee subscription
 * @param type $cbSubscriptionID
 * @return string
 */
function cbHelperReactivateSubscription($cbSubscriptionID) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::reactivate($cbSubscriptionID);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}


/**
 * Pause chargebee subscription
 * @param type $cbSubscriptionID
 * @return string
 */
function cbHelperPauseSubscription($cbSubscriptionID) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::pause($cbSubscriptionID);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}


/**
 * Resume chargebee subscription
 * @param type $cbSubscriptionID
 * @return string
 */
function cbHelperResumeSubscription($cbSubscriptionID) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::resume($cbSubscriptionID);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}


/**
 * Delete chargebee subscription
 * @param type $cbSubscriptionID
 * @return string
 */
function cbHelperDeleteSubscription($cbSubscriptionID) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::delete($cbSubscriptionID);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Used to retrieve subscription details from chargebee
 * @param type $cbSubscriptionID
 * @return string
 */
function cbHelperRetrieveSubscription($cbSubscriptionID) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            $aResponse = ChargeBee_Subscription::retrieve($cbSubscriptionID);
            $oRes = $aResponse->subscription();
            return $oRes;
        } catch (Exception $ex) {
            return '';
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Helper chargebee function prototype
 */
function cbHelperPrototyp($aData) {
    $bConfiguredSuccess = initCbConfiguration();
    if ($bConfiguredSuccess == true) {
        try {
            //write your own code             
        } catch (Exception $ex) {
            
        }
    } else {
        die('Something went wrong');
    }
}

/**
 * Only for testing purpose
 */
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
    } else {
        die('Something went wrong');
    }
}

?>