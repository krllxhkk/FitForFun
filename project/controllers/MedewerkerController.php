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
    // Nieuwe medewerker toevoegen
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = [
            'naam' => trim($_POST['naam']),
            'functie' => trim($_POST['functie']),
            'email' => trim($_POST['email']),
            'telefoon' => trim($_POST['telefoon']),
            'fout' => ''
        ];

        try {
            // Proberen om medewerker op te slaan
            $this->medewerkerModel->addMedewerker($data);

            header('Location: ' . URLROOT . '/public/index.php?url=medewerker/index');
            exit;

        } catch (Exception $e) {
            // Vriendelijke foutmelding tonen
            $data['fout'] = 'De medewerker kon niet worden opgeslagen door een databasefout.';
            $data['medewerkers'] = $this->medewerkerModel->getMedewerkers();

            $this->view('medewerkers', $data);
            return;
        }
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