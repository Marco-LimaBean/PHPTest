<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/12/2017
 * Time: 7:27 AM
 */

class dvdShort
{
    private $id, $name;
    /**
     * dvdShort constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}

class dvd extends dvdShort implements JsonSerializable
{
    private $id, $name, $description, $releaseDate, $category_id, $category_name, $count;

    /**
     * dvd constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $releaseDate
     * @param $category_id
     * @param $category_name
     * @param int $count total number of DVD or how many DVD to add to the list
     */
    public function __construct($id, $name, $description, $releaseDate, $category_id, $category_name = false, $count = 0)
    {
        parent::__construct($id, $name);
        $this->description = $description;
        $this->releaseDate = $releaseDate;
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @param mixed $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @param mixed $category_id
     */
    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $category_name
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    public function increaseCount($count){
        $this->count += $count;
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
        //$id, $name, $description, $releaseDate, $category_id, $category_name, $count;
        return array(
            'id' => intval($this->id),
            'name' => $this->name,
            'description' => $this->description,
            'release_date' => $this->releaseDate,
            'category_id' => intval($this->category_id),
            'category_name' => $this->category_name,
            'count' => intval($this->count)
        );
    }

    public function toString()
    {

        return 'id: ' . intval($this->getId()). ' name: '. $this->name . ' description: ' . $this->description .
            ' release_date: ' . $this->releaseDate . ' category_id: ' . intval($this->category_id) .
            ' category_name: ' . $this->category_name .  ' count: ' . intval($this->count). ";";

    }
}