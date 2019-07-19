<?php

namespace app\controllers;

use app\components\core\Controller as BaseController;
use app\components\Auth;
use app\classes\Licence;
use app\classes\Customer;
use app\components\commons\CsrfSecurity;

class CartController extends BaseController
{
    public function actionBuy()
    {
        // Redirect to index ,login if the user is not logged in
        $isLogged = (new Auth)->isLogged();
        if (!$isLogged) {
            $this->redirectToRoute('index', 'login');
        }
        
        $idLicense = $_GET['id'];

        $idCustomer = (new Auth)->getSession('id_customer');
        $displayName = (new Auth)->getSession('email');

        $customer = (new Customer)->getById($idCustomer);
        $idLicenseCustomer = $customer->license;

        // Expiration date is current date + 1 year
        $expirationDate = date('Y-m-d', strtotime('+1 year'));

        if (isset($idLicense)) {
            $license = (new Licence)->getById($idLicense);
            // if there is a license
            // expiration date will be end of license expiration date + 1 year (continous)
            if ($customer->id_license && $customer->license_expiration) {
                $continousExpirationDate = date("Y-m-d", strtotime("+1 year", strtotime($customer->license_expiration)));
            }
            // Compare which expiration date is greater
            if (isset($continousExpirationDate) && $continousExpirationDate > $expirationDate) {
                $expirationDate = $continousExpirationDate;
            }
            if (isset($_POST['order']) && $_POST['order'] && CsrfSecurity::checkCsrfToken($_POST['csrf_token'])) {
                $idLicense = $_POST['order']['idLicense'];
                // load new customer license data
                $customer->loadData(
                    [
                            'id_license' => $idLicense,
                            'license_expiration' => $expirationDate
                        ]
                    );
                // save customer license
                $customer->save();
                // redirect to My Account
                $this->redirectToRoute('account', 'view');
            }
        }

        $this->renderView(
            'views/cart/buy',
            [
            'isLogged' => $isLogged,
            'displayName' => $displayName,
            'license' => $license,
            'expirationDate' => $expirationDate
            ]
        );
    }
}
