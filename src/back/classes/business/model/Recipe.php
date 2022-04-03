<?php

/**
 * Class Recipe
 * @author arthur mimouni
 */
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
    private $categories;
    /**
     * @var string
     */
    private $url_pic;
    /**
     * @var string
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
     * @var int
     */
    private $break_time;
    /**
     * @var string
     */
    private $difficulty;
    /**
     * @var string
     */
    private $budget;
    /**
     * @var int
     */
    private $serving;
    /**
     * @var string
     */
    private $coord;
    /**
     * @var array
     */
    private $ingredients;
    /**
     * @var int
     */
    private $cluster;
    /**
     * @var float
     */
    private $score;
    /**
     * @var string
     */
    private $close_to;

    /**
     * Recipe constructor.
     * @param int $id
     * @param string $name
     * @param string $categories
     * @param string $url_pic
     * @param string $directions
     * @param int $prep_time
     * @param int $cook_time
     * @param int $break_time
     * @param string $difficulty
     * @param string $budget
     * @param int $serving
     * @param string $coord
     * @param array $ingredients
     * @param int $cluster
     * @param float $score
     * @param string $close_to
     */
    public function __construct($id, $name = '', $url_pic = '', $categories = '', $directions = '', $prep_time = 0,
                                $cook_time = 0, $break_time = 0, $difficulty = '', $budget = '', $serving = 0, $cluster = -1,
                                $coord='', $ingredients = array(), $score = 0, $close_to ='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->categories = $categories;
        $this->url_pic = $url_pic;
        $this->directions = $directions;
        $this->prep_time = $prep_time;
        $this->cook_time = $cook_time;
        $this->break_time = $break_time;
        $this->difficulty = $difficulty;
        $this->budget = $budget;
        $this->serving = $serving;
        $this->coord = $coord;
        $this->ingredients = $ingredients;
        $this->cluster = $cluster;
        $this->score = $score;
        $this->close_to = $close_to;
    }

    /**
     * @param Ingredient $id_ingredient
     * @return bool
     */
    public function hasIngredient($ingredient):bool
    {
        foreach ($this->ingredients as $ingredient_user) {
            if($ingredient_user->getId() == $ingredient->getId())
                return true;
        }
        return false;
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
    public function setId(int $id)
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
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
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
    public function getDirections()
    {
        return $this->directions;
    }

    /**
     * @param string $directions
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
     * @return int
     */
    public function getBreakTime()
    {
        return $this->break_time;
    }

    /**
     * @param int $break_time
     */
    public function setBreakTime($break_time)
    {
        $this->break_time = $break_time;
    }

    /**
     * @return string
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * @param string $difficulty
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param string $budget
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
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
     * @return string
     */
    public function getCoord()
    {
        return $this->coord;
    }

    /**
     * @param string $coord
     */
    public function setCoord($coord)
    {
        $this->coord = $coord;
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
     * @return int
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * @param int $cluster
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;
    }

    /**
     * @return float
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param float $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function getCloseTo()
    {
        return $this->close_to;
    }

    /**
     * @param string $close_to
     */
    public function setCloseTo(string $close_to)
    {
        $this->close_to = $close_to;
    }
}