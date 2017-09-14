<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 9:45 AM
 */

class orderLine
{
    private $id, $customer_id, $rent_date, $due_date, $actual_return_date;

    /**
     * orderLine constructor.
     * @param $id
     * @param $customer_id
     * @param $rent_date
     * @param $due_date
     * @param $actual_return_date
     */
    public function __construct($customer_id, $rent_date, $due_date, $actual_return_date = false, $id = false)
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->rent_date = $rent_date;
        $this->due_date = $due_date;
        $this->actual_return_date = $actual_return_date;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param mixed $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return mixed
     */
    public function getRentDate()
    {
        return $this->rent_date;
    }

    /**
     * @param mixed $rent_date
     */
    public function setRentDate($rent_date)
    {
        $this->rent_date = $rent_date;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * @param mixed $due_date
     */
    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;
    }

    /**
     * @return string
     */
    public function getActualReturnDate()
    {
        return $this->actual_return_date;
    }

    /**
     * @param string $actual_return_date
     */
    public function setActualReturnDate($actual_return_date)
    {
        $this->actual_return_date = $actual_return_date;
    }
}