<?php

class Account {

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAccounts()
    {
        $this->db->query("SELECT * FROM accounts");
        return $this->db->resultSet();
    }

    public function addAccount($data)
    {
        $this->db->query("INSERT INTO accounts (naam,email,rol)
        VALUES (:naam,:email,:rol)");

        $this->db->bind(':naam',$data['naam']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':rol',$data['rol']);

        return $this->db->execute();
    }

    public function deleteAccount($id)
    {
        $this->db->query("DELETE FROM accounts WHERE id = :id");
        $this->db->bind(':id',$id);

        return $this->db->execute();
    }
}