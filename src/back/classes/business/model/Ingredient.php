<?php

class Ingredient
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $url_pic;

    /**
     * Ingredient constructor.
     * @param int $id
     * @param string $name
     * @param string $url_pic
     */
    public function __construct($id, $name, $url_pic="")
    {
        $this->id = $id;
        $this->name = $name;
        $this->url_pic = $url_pic;
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
    public function getUrlPic()
    {
        return $this->url_pic;
    }

    /**
     * @param string $url_pic
     */
    public function setUrlPic($url_pic)
    {
        $this->url_pic = $url_pic;
    }

}