<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/11/2017
 * Time: 1:20 PM
 */

class customer
{
    private $id, $name, $surname, $contact_number, $email, $sa_id_number, $address;

    /**
     * customer constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $contact_number
     * @param $email
     * @param $sa_id_number
     * @param $address
     */
    public function __construct($name = "", $surname = "", $contact_number = "", $email = "", $sa_id_number = "", $address = "", $id = "false")
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->contact_number = $contact_number;
        $this->email = $email;
        $this->sa_id_number = $sa_id_number;
        $this->address = $address;
        if($name != ""){
            $this->id = $id;
        }
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getContactNumber()
    {
        return $this->contact_number;
    }

    /**
     * @param string $contact_number
     */
    public function setContactNumber($contact_number)
    {
        $this->contact_number = $contact_number;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSaIdNumber()
    {
        return $this->sa_id_number;
    }

    /**
     * @param string $sa_id_number
     */
    public function setSaIdNumber($sa_id_number)
    {
        $this->sa_id_number = $sa_id_number;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function toString(){
        return "ID: " . $this->id . " Name: " . $this->name . " Surname: " . $this->surname .
            " Contact number: " . $this->contact_number . " Email: " . $this->email . " SA ID: " . $this->sa_id_number .
            " Address: " . $this->address;
    }
}