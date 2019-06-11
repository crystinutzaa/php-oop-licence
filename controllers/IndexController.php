<?php

namespace app\controllers;

use app\components\core\Controller as BaseController;
use app\components\Auth;
use app\classes\Licence;
use app\classes\Customer;
use app\components\commons\CsrfSecurity;

class IndexController extends BaseController
{

    public function actionIndex()
    {
        $licenses = (new Licence)->getAll();

        $isLogged = (new Auth)->isLogged();
        $displayName = NULL;

        $idLicense = NULL;
        $expiredLicense = NULL;
        if (isset($_GET['expiredLicense'])) {
            $expiredLicense = $_GET['expiredLicense'];
        }
        if ($isLogged) {
            $displayName = (new Auth)->getSession('email');

            $idCustomer = (new Auth)->getSession('id_customer');
            $customer = (new Customer)->getById($idCustomer);
            $idLicense = $customer->id_license;
            $expirationDate = $customer->license_expiration;
        }
        $this->renderView(
            'views/index/index', [
            'licenses' => $licenses,
            'isLogged' => $isLogged,
            'displayName' => $displayName,
            'idLicense' => $idLicense,
            'expiredLicense' => $expiredLicense
            ]
        );
    }

    public function actionLogin()
    {
        $login = new Auth();

        if (isset($_POST['login']) && $_POST['login'] && CsrfSecurity::checkCsrfToken($_POST['csrf_token'])) {
            $login->loadData($_POST['login']);
            if ($login->validateLogin() && $login->login()) {
                // Redirec to view account
                $this->redirectToRoute('account', 'view');
            }
        }

        $this->renderView('views/index/login', ['login' => $login]);
    }

    public function actionCreateAccount()
    {
        $login = new Auth();

        if (isset($_POST['createAccount']) && $_POST['createAccount'] && CsrfSecurity::checkCsrfToken($_POST['csrf_token'])) {
            $login->loadData($_POST['createAccount']);

            if ($login->validateCreateAccount() &&  $login->createAccount()) {
                // Redirect to account view
                $this->redirectToRoute('account', 'view');
            }
        }

        $this->renderView('views/index/createaccount', ['login' => $login]);
    }

    public function actionLogout()
    {

        Auth::logout();
        // Redirect to index page
        $this->redirectToRoute('index', 'index');
    }
}
