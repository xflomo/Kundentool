<?php
namespace Fbreuer\Cms;


class Kunde
{
    protected $firstname;
    protected $lastname;
    protected $company;
    protected $mail;
    protected $phone;


    public function __construct($firstname, $lastname, $company, $mail, $phone)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->company = $company;
        $this->mail = $mail;
        $this->phone = $phone;
    }


    // Get Methoden

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getCompany()
    {
        return $this->company;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPhone()
    {
        return $this->phone;
    }



    public function addKundenToDatabase($company)
    {
        // Database Class Anbindung
    }

}