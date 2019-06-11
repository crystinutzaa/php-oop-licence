<?php

namespace app\controllers;

use app\components\core\Controller as BaseController;
use app\components\Auth;
use app\classes\Licence;
use app\classes\Website;
use app\classes\Customer;
use app\components\commons\CsrfSecurity;

class AccountController extends BaseController
{

    public function actionView()
    {
        // Redirect to index ,login if the user is not logged in
        $isLogged = (new Auth)->isLogged();
        if (!$isLogged) {
            $this->redirectToRoute('index', 'login');
        }


        $idCustomer = (new Auth)->getSession('id_customer');
        $displayName = (new Auth)->getSession('email');
        $websites = (new Website)->getByIdCustomer($idCustomer);
        $customer = (new Customer)->getById($idCustomer);

        $idLicense = NULL;
        $expirationDate = NULL;

        $idLicense = $customer->id_license;
        $expirationDate = $customer->license_expiration;

        $license = NULL;

        $licenseIsExpired = false;
        if (isset($idLicense)) {
            $license = (new Licence)->getById($idLicense);

            // check if licence is expired
            $now = time();

            if (strtotime($expirationDate) < $now) {
                // license is expired
                $licenseIsExpired = true;
            }

            if (isset($_POST['websites']) && $_POST['websites'] && CsrfSecurity::checkCsrfToken($_POST['csrf_token'])) {
                for ($i = 0; $i < $license->allowed_websites; $i++) {
                    $website = new Website();

                    $idWebsite = $_POST['websites']['id_website'][$i];

                    $website->loadData(
                        [
                            'id_website' => $idWebsite,
                            'id_customer' => $idCustomer,
                            'url' => $_POST['websites']['url'][$i]
                        ]
                    );

                    if (!$website->save()) {
                        $websites[$i] = $website;
                    } else {
                        // Reload websites after save
                        $websites = (new Website)->getByIdCustomer($idCustomer);
                    }
                }
            }
        }
        $this->renderView(
            'views/account/view', [
            'websites' => $websites,
            'isLogged' => $isLogged,
            'displayName' => $displayName,
            'license' => $license,
            'expirationDate' => $expirationDate,
            'licenseIsExpired' => $licenseIsExpired
            ]
        );
    }
}
