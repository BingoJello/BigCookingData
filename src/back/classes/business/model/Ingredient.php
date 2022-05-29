<?php

/**
 * Class Ingredient
 * @author arthur mimouni
 */
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
     * @var string
     */
    private $quantity;
    /**
     * @var string|null
     */
    private $unity;

    /**
     * Ingredient constructor.
     * @param int $id
     * @param string $name
     * @param string $url_pic
     * @param string $unity
     */
    public function __construct($id, $name, $url_pic="", $quantity = 0, $unity = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url_pic = $url_pic;
        $this->quantity = $quantity;
        $this->unity = $unity;
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

    /**
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getUnity()
    {
        return $this->unity;
    }

    /**
     * @param string $unity
     */
    public function setUnity($unity): void
    {
        $this->unity = $unity;
    }
}