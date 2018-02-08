<?php
/**
 * class.authCAS.php
 * Processmaker Plugin to integrate processmaker with CAS authentication
 */

G::LoadClass("wsBase");

class authCASClass extends PMPlugin {
    function __construct() {
        set_include_path(
            PATH_PLUGINS . 'authCAS' . PATH_SEPARATOR .
            get_include_path()
        );
    }

    // Skeleton methods required my PM
    function setup()
    {
    }

    function getFieldsForPageSetup()
    {
    }

    function updateFieldsForPageSetup()
    {
    }

    /**
     * This method is the main method used for performing CAS authentication
     * @return bool
     */
    function casLogin() {
        $result = false;

        $RBAC = RBAC::getSingleton();
        $RBAC->initRBAC();

        require_once 'lib/CAS-1.3.5/CAS.php';
        $cas_info = parse_ini_file('authCASconfig.ini');

        // Uncomment to log CAS session information
        phpCAS::setDebug(dirname(__FILE__) . '/cas.log');

        phpCAS::client($cas_info['VERSION'], $cas_info['SERVER'], (int) $cas_info['PORT'], $cas_info['URI'], false);
        phpCAS::setNoCasServerValidation();

        // Avoid unnecessary redirect
        if (phpCAS::checkAuthentication() === false) {
            phpCAS::forceAuthentication();
        }

        $cas_user = phpCAS::getUser();
        $pm_user_sql = "SELECT USR_UID FROM USERS WHERE USR_USERNAME = '$cas_user'";
        $pm_user_result = executeQuery($pm_user_sql);

        // If the provided username exists
        // set RBAC properties required by PM
        if (count($pm_user_result)) {
            $user_id = $pm_user_result[1]['USR_UID'];

            // Set RBAC for postprocessing
            $RBAC->verifyUser($cas_user);
            $RBAC->singleSignOn = true;
            $RBAC->userObj->fields['USR_UID'] = $user_id;
            $RBAC->userObj->fields['USR_USERNAME'] = $cas_user;

            $result = true;
        }

        return $result;
    }
}
?>