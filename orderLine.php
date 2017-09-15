<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/14/2017
 * Time: 9:45 AM
 */

class orderLine
{
    protected $order_id, $customer_id, $rent_date, $due_date, $actual_return_date;

    /**
     * @param $customer_id
     * @param $rent_date
     * @param $due_date
     * @param string $actual_return_date
     * @param bool|int $order_id
     */
    public function __construct($customer_id, $rent_date, $due_date, $actual_return_date = 'NULL', $order_id = false)
    {
        $this->order_id = $order_id;
        $this->customer_id = $customer_id;
        $this->rent_date = $rent_date;
        $this->due_date = $due_date;
        $this->actual_return_date = $actual_return_date;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
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

class orderLineItem extends orderLine
{
    private $dvdShortArray;

    /**
     * orderLineItem constructor.
     * @param bool $order_id int
     * @param $customer_id int
     * @param $rent_date
     * @param string $due_date
     * @param string $actual_return_date
     * @param array|dvdShort $dvdShort dvdShort
     */
    public function __construct($order_id, $customer_id, $rent_date, $due_date, $actual_return_date = 'NULL', array $dvdShort)
    {
        parent::__construct($customer_id, $rent_date, $due_date, $actual_return_date = 'NULL', $order_id);
        if (!class_exists("dvdShort")) include("dvd.php");
        $this->dvdShortArray = $dvdShort;
    }

    /**
     * @return dvdShort
     */
    public function getDvdShortArray()
    {
        return $this->dvdShortArray;
    }

    /**
     * @param dvdShort $dvdShortArray
     */
    public function setDvdShortArray($dvdShortArray)
    {
        $this->dvdShortArray = $dvdShortArray;
    }
}