<?php

class Lid
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLeden()
    {
        $this->db->query("SELECT * FROM leden ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function addLid($data)
    {
        $this->db->query("INSERT INTO leden (naam, email, telefoon, created_at) 
                          VALUES (:naam, :email, :telefoon, :created_at)");

        $this->db->bind(':naam', $data['naam']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefoon', $data['telefoon']);
        $this->db->bind(':created_at', $data['created_at']);

        return $this->db->execute();
    }

    public function getLidById($id)
    {
        $this->db->query("SELECT * FROM leden WHERE id = :id");
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
        return $result[0] ?? null;
    }

    public function updateLid($data)
    {
        $this->db->query("UPDATE leden 
                          SET naam = :naam, email = :email, telefoon = :telefoon
                          WHERE id = :id");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':naam', $data['naam']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telefoon', $data['telefoon']);

        return $this->db->execute();
    }

    public function deleteLid($id)
    {
        $this->db->query("DELETE FROM leden WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function countLedenPerPeriode($van, $tot)
    {
        $this->db->query("SELECT COUNT(*) AS totaal 
                          FROM leden 
                          WHERE created_at BETWEEN :van AND :tot");
        $this->db->bind(':van', $van);
        $this->db->bind(':tot', $tot);

        $result = $this->db->resultSet();
        return $result[0] ?? null;
    }

    public function zoekOpAchternaam($zoekterm)
    {
        $this->db->query("SELECT * FROM leden WHERE naam LIKE :zoekterm ORDER BY naam ASC");
        $this->db->bind(':zoekterm', '%' . $zoekterm . '%');

        return $this->db->resultSet();
    }
}