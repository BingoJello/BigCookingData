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
    private $urlPic;

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
    private $prepTime;

    /**
     * @var int
     */
    private $cookTime;

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
     * @param string $urlPic
     * @param string $summary
     * @param array $directions
     * @param int $prepTime
     * @param int $cookTime
     * @param string $yield
     * @param int $serving
     * @param Nutrition $nutrition
     * @param array $ingredients
     * @param array $categories
     * @param double $score
     */
    public function __construct($id, $name, $urlPic, $summary, $directions, $prepTime, $cookTime, $yield, $serving,
                                Nutrition $nutrition, $ingredients, $categories, $score = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->urlPic = $urlPic;
        $this->summary = $summary;
        $this->directions = $directions;
        $this->prepTime = $prepTime;
        $this->cookTime = $cookTime;
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
        return $this->urlPic;
    }

    /**
     * @param string $urlPic
     */
    public function setUrlPic($urlPic)
    {
        $this->urlPic = $urlPic;
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
        return $this->prepTime;
    }

    /**
     * @param int $prepTime
     */
    public function setPrepTime($prepTime)
    {
        $this->prepTime = $prepTime;
    }

    /**
     * @return int
     */
    public function getCookTime()
    {
        return $this->cookTime;
    }

    /**
     * @param int $cookTime
     */
    public function setCookTime($cookTime)
    {
        $this->cookTime = $cookTime;
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