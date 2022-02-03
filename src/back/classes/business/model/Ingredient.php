<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

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
     * @var double
     */
    private $score;

    /**
     * Ingredient constructor.
     * @param int $id
     * @param string $name
     * @param double $score
     */
    public function __construct($id, $name, $score = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->score = $score;
    }

    public function incrementScore(){
        $this->score = $this->score++;
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
}