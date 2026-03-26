<?php

class Medewerker
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMedewerkers()
    {
        $this->db->query("SELECT * FROM medewerkers ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function addMedewerker($data)
    {
        $this->db->query("INSERT INTO medewerkers (naam, functie, email, telefoon) 
                          VALUES (:naam, :functie, :email, :telefoon)");

        $this->db->bind(':naam', $data['naam']);
        $this->db->bind(':functie', $data['functie']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefoon', $data['telefoon']);

        return $this->db->execute();
    }

    public function getMedewerkerById($id)
    {
        $this->db->query("SELECT * FROM medewerkers WHERE id = :id");
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
        return $result[0] ?? null;
    }

    public function updateMedewerker($data)
    {
        $this->db->query("UPDATE medewerkers 
                          SET naam = :naam, functie = :functie, email = :email, telefoon = :telefoon
                          WHERE id = :id");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':naam', $data['naam']);
        $this->db->bind(':functie', $data['functie']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefoon', $data['telefoon']);

        return $this->db->execute();
    }

    public function deleteMedewerker($id)
    {
        $this->db->query("DELETE FROM medewerkers WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
}