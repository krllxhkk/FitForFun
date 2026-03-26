<?php

class MedewerkerController extends BaseController {

    private $medewerkerModel;

    public function __construct()
    {
        $this->medewerkerModel = $this->model('Medewerker');
    }

    public function index()
    {
        $medewerkers = $this->medewerkerModel->getMedewerkers();

        $data = [
            'medewerkers' => $medewerkers
        ];

        $this->view('medewerkers',$data);
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $data = [
                'naam' => $_POST['naam'],
                'functie' => trim($_POST['functie']),
                'email' => $_POST['email'],
                'telefoon' => $_POST['telefoon']
            ];

            $this->medewerkerModel->addMedewerker($data);

            header('Location: ' . URLROOT . '/public/index.php?url=medewerker/index');
exit;
        }
    }

    public function delete($id)
    {
        $this->medewerkerModel->deleteMedewerker($id);

       header('Location: ' . URLROOT . '/public/index.php?url=medewerker/index');
exit;
    }
public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'id' => $id,
            'naam' => trim($_POST['naam']),
            'functie' => trim($_POST['functie']),
            'email' => trim($_POST['email']),
            'telefoon' => trim($_POST['telefoon'])
        ];

        $this->medewerkerModel->updateMedewerker($data);

        header('Location: ' . URLROOT . '/public/index.php?url=medewerker/index');
        exit;
    } else {
        $medewerker = $this->medewerkerModel->getMedewerkerById($id);

        $data = [
            'medewerker' => $medewerker
        ];

        $this->view('medewerker_edit', $data);
    }
}
}