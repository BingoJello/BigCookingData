<?php

class Recipe
{
    private int $id;
    private string $name;
    private string $categories;
    private string $url_pic;
    private string $directions;
    private int $prep_time;
    private int $cook_time;
    private int $break_time;
    private string $difficulty;
    private string $budget;
    private int $serving;
    private string $coord;
    private array $ingredients;
    private int $cluster;

    /**
     * Recipe constructor.
     */
    public function __construct(int $id, string $name = '', string $categories = '', string $url_pic = '',
                                string $directions = '', int $prep_time = 0, int $cook_time = 0, int $break_time = 0,
                                string $difficulty = '', string $budget = '', int $serving = 0,  string $coord='',
                                array $ingredients = array(), int $cluster = -1)
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
    }

    public function hasIngredient($id_ingredient):bool
    {
        foreach ($this->ingredients as $ingredient)
        {
            if($ingredient->getId() == $id_ingredient)
                return true;
        }
        return false;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getCategories(): string
    {
        return $this->categories;
    }

    public function setCategories(string $categories): void
    {
        $this->categories = $categories;
    }

    public function getUrlPic():string
    {
        return $this->url_pic;
    }

    public function setUrlPic(string $url_pic):void
    {
        $this->url_pic = $url_pic;
    }
    public function getDirections():string
    {
        return $this->directions;
    }

    public function setDirections(string $directions):void
    {
        $this->directions = $directions;
    }

    public function getPrepTime():int
    {
        return $this->prep_time;
    }

    public function setPrepTime(int $prep_time):void
    {
        $this->prep_time = $prep_time;
    }

    public function getCookTime():int
    {
        return $this->cook_time;
    }

    public function setCookTime(int $cook_time):void
    {
        $this->cook_time = $cook_time;
    }

    public function getBreakTime():int
    {
        return $this->cook_time;
    }

    public function setBreakTime(int $break_time):void
    {
        $this->break_time = $break_time;
    }

    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    public function getBudget(): string
    {
        return $this->budget;
    }

    public function setBudget(string $budget): void
    {
        $this->budget = $budget;
    }

    public function getServing():int
    {
        return $this->serving;
    }

    public function setServing(int $serving):void
    {
        $this->serving = $serving;
    }

    public function getIngredients():array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients):void
    {
        $this->ingredients = $ingredients;
    }

    public function getCoord(): string
    {
        return $this->coord;
    }

    public function setCoord(string $coord): void
    {
        $this->coord = $coord;
    }

    public function getCluster():Cluster
    {
        return $this->cluster;
    }

    public function setCluster(Cluster $cluster):void
    {
        $this->cluster = $cluster;
    }
}