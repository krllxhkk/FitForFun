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
    // Nieuw lid toevoegen
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'naam' => trim($_POST['naam']),
            'email' => trim($_POST['email']),
            'telefoon' => trim($_POST['telefoon']),
            'created_at' => date('Y-m-d'),
            'fout' => ''
        ];

        // Basis validatie
        if (empty($data['naam'])) {
            $data['fout'] = 'Naam is verplicht.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['fout'] = 'Voer een geldig e-mailadres in.';
        }

        // Bij validatiefout terug naar overzicht
        if (!empty($data['fout'])) {
            $data['leden'] = $this->lidModel->getLeden();
            $this->view('leden', $data);
            return;
        }

        try {
    // Proberen om data op te slaan
    $this->lidModel->addLid($data);

    header('Location: ' . URLROOT . '/public/index.php?url=leden/index');
    exit;

} catch (Exception $e) {
    // Vriendelijke foutmelding tonen
    $data['fout'] = 'De gegevens konden niet worden opgeslagen door een databasefout.';
    $data['leden'] = $this->lidModel->getLeden();

    $this->view('leden', $data);
    return;
}
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
    // Bewerken van medewerker
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $data = [
            'id' => $id,
            'naam' => trim($_POST['naam']),
            'functie' => trim($_POST['functie']),
            'email' => trim($_POST['email']),
            'telefoon' => trim($_POST['telefoon']),
            'fout' => ''
        ];

        try {
            // Proberen om wijzigingen op te slaan
            $this->medewerkerModel->updateMedewerker($data);

            header('Location: ' . URLROOT . '/public/index.php?url=medewerker/index');
            exit;

        } catch (Exception $e) {
            // Fout netjes tonen op de pagina
            $data['fout'] = 'De medewerker kon niet worden bijgewerkt door een databasefout.';
            $data['medewerker'] = (object)$data;

            $this->view('medewerker_edit', $data);
            return;
        }

    } else {
        try {
            // Gegevens ophalen voor edit pagina
            $medewerker = $this->medewerkerModel->getMedewerkerById($id);

            $data = [
                'medewerker' => $medewerker,
                'fout' => ''
            ];

            $this->view('medewerker_edit', $data);

        } catch (Exception $e) {
            // Fout bij laden (bijv. ontbrekende kolom)
            $data = [
                'fout' => 'Gegevens konden niet worden geladen door een databasefout.',
                'medewerker' => (object)[
                    'naam' => '',
                    'functie' => '',
                    'email' => '',
                    'telefoon' => ''
                ]
            ];

            $this->view('medewerker_edit', $data);
        }
    }
}
}