<?php

class LedenController extends BaseController {

    private $lidModel;

    public function __construct()
    {
        $this->lidModel = $this->model('Lid');
    }

    public function zoeken()
{
    $resultaten = [];
    $zoekterm = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $zoekterm = trim($_POST['zoekterm'] ?? '');
        $resultaten = $this->lidModel->zoekOpAchternaam($zoekterm);
    }

    $data = [
        'zoekterm' => $zoekterm,
        'resultaten' => $resultaten
    ];

    $this->view('leden_zoeken', $data);
}

    public function index()
    {
        $leden = $this->lidModel->getLeden();

        $data = [
            'leden' => $leden
        ];

        $this->view('leden',$data);
    }

    public function add()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'naam' => trim($_POST['naam']),
            'email' => trim($_POST['email']),
            'telefoon' => trim($_POST['telefoon']),
            'created_at' => date('Y-m-d')
        ];

        $this->lidModel->addLid($data);

        header('Location: ' . URLROOT . '/public/index.php?url=leden/index');
        exit;
    }
}

    public function delete($id)
    {
        $this->lidModel->deleteLid($id);

        header('Location: ' . URLROOT . '/public/index.php?url=leden/index');
exit;
    }
    public function overzicht()
{
    $resultaat = null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $van = $_POST['van'];
        $tot = $_POST['tot'];

        $queryResult = $this->lidModel->countLedenPerPeriode($van, $tot);
        $resultaat = $queryResult->totaal ?? 0;
    }

    $data = [
        'resultaat' => $resultaat
    ];

    $this->view('leden_overzicht', $data);
}

    public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'id' => $id,
            'naam' => trim($_POST['naam']),
            'email' => trim($_POST['email']),
            'telefoon' => trim($_POST['telefoon'])
        ];

        $this->lidModel->updateLid($data);

        header('Location: ' . URLROOT . '/public/index.php?url=leden/index');
        exit;
    } else {
        $lid = $this->lidModel->getLidById($id);

        $data = [
            'lid' => $lid
        ];

        $this->view('leden_edit', $data);
    }
}
}