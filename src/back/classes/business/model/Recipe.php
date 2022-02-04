<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Recipe
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
    private $summary;

    /**
     * @var array
     */
    private $directions;

    /**
     * @var int
     */
    private $prep_time;

    /**
     * @var int
     */
    private $cook_time;

    /**
     * @var string
     */
    private $yield;

    /**
     * @var int
     */
    private $serving;

    /**
     * @var Nutrition
     */
    private $nutrition;

    /**
     * @var array
     */
    private $ingredients;

    /**
     * @var array
     */
    private $categories;

    /**
     * @var double
     */
    private $score;

    /**
     * Recipe constructor.
     * @param int $id
     * @param string $name
     * @param string $url_pic
     * @param string $summary
     * @param array $directions
     * @param int $prep_time
     * @param int $cook_time
     * @param string $yield
     * @param int $serving
     * @param Nutrition $nutrition
     * @param array $ingredients
     * @param array $categories
     * @param double $score
     */
    public function __construct($id, $name, $url_pic, $summary, $directions, $prep_time, $cook_time, $yield, $serving,
                                Nutrition $nutrition, $ingredients, $categories, $score = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->url_pic = $url_pic;
        $this->summary = $summary;
        $this->directions = $directions;
        $this->prep_time = $prep_time;
        $this->cook_time = $cook_time;
        $this->yield = $yield;
        $this->serving = $serving;
        $this->nutrition = $nutrition;
        $this->ingredients = $ingredients;
        $this->categories = $categories;
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
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return array
     */
    public function getDirections()
    {
        return $this->directions;
    }

    /**
     * @param array $directions
     */
    public function setDirections($directions)
    {
        $this->directions = $directions;
    }

    /**
     * @return int
     */
    public function getPrepTime()
    {
        return $this->prep_time;
    }

    /**
     * @param int $prep_time
     */
    public function setPrepTime($prep_time)
    {
        $this->prep_time = $prep_time;
    }

    /**
     * @return int
     */
    public function getCookTime()
    {
        return $this->cook_time;
    }

    /**
     * @param int $cook_time
     */
    public function setCookTime($cook_time)
    {
        $this->cook_time = $cook_time;
    }

    /**
     * @return string
     */
    public function getYield()
    {
        return $this->yield;
    }

    /**
     * @param string $yield
     */
    public function setYield($yield)
    {
        $this->yield = $yield;
    }

    /**
     * @return int
     */
    public function getServing()
    {
        return $this->serving;
    }

    /**
     * @param int $serving
     */
    public function setServing($serving)
    {
        $this->serving = $serving;
    }

    /**
     * @return Nutrition
     */
    public function getNutrition()
    {
        return $this->nutrition;
    }

    /**
     * @param Nutrition $nutrition
     */
    public function setNutrition($nutrition)
    {
        $this->nutrition = $nutrition;
    }

    /**
     * @return array
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param array $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
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