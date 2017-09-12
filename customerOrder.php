<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 8:16 AM
 */

class customerOrder
{
    private $customerID, $dvdArray = array(), $total;

    /**
     * customerOrder constructor.
     * @param $customerID
     * @param $dvdArray
     * @param $total
     */
    public function __construct($customerID, $dvdArray = array(), $total = 0)
    {
        $this->customerID = $customerID;
        $this->dvdArray = $dvdArray;
        $this->total = $total;
    }

    /** Give a dvd object to add the dvd object to the array or increase its count.
     * @param $dvd dvd
     * @return bool
     */
    public function addDvd($dvd){
        if(get_class($dvd) != "dvd"){ //if given $dvd is not an object of dvd class.
            return false;
        }

        if(!empty($this->dvdArray)){
            //check if the dvd exists within the array.
            foreach ($this->dvdArray as $key => $value){
                if($dvd->getId() == $value->getId()){
                    $value->increaseCount();
                    continue;
                }
            }
        }

        array_push($this->dvdArray, $dvd);
        end($this->dvdArray)->increaseCount();
        return true;
    }

}