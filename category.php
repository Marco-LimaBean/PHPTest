<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 1:19 PM
 */

class category
{
    private $id, $category;

    /**
     * category constructor.
     * @param $id
     * @param $category
     */
    public function __construct($id, $category)
    {
        $this->id = $id;
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}