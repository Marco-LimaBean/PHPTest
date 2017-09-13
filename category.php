<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 1:19 PM
 */

class category implements JsonSerializable
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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array(
            'id' => intval($this->id),
            'category' => $this->category
        );
    }
}