<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Category
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
     * @var double
     */
    private $score;

    /**
     * @var Category
     */
    private $child_of;

    /**
     * Category constructor.
     * @param int $id
     * @param string $name
     * @param Category $child_of
     */
    public function __construct($id, $name, Category $child_of = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->child_of = $child_of;
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
     * @return double
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param double $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return Category
     */
    public function getChildOf()
    {
        return $this->child_of;
    }

    /**
     * @param Category $child_of
     */
    public function setChildOf($child_of)
    {
        $this->child_of = $child_of;
    }

}