<?php

class AccountController extends BaseController {

    private $accountModel;

    public function __construct()
    {
        $this->accountModel = $this->model('Account');
    }

    public function index()
    {
        $accounts = $this->accountModel->getAccounts();

        $data = [
            'accounts' => $accounts
        ];

        $this->view('leden',$data);
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = [
                'naam' => $_POST['naam'],
                'email' => $_POST['email'],
                'telefoon' => $_POST['telefoon']
            ];

            $this->accountModel->addAccount($data);

            header("Location: /accounts/index");
        }
    }

    public function delete($id)
    {
        $this->accountModel->deleteAccount($id);

        header("Location: /accounts/index");
    }
}