<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Recipe
{
    private int $id;
    private string $name;
    private string $url_pic;
    private string $summary;
    private array $directions;
    private int $prep_time;
    private int $cook_time;
    private string $yield;
    private int $serving;
    private array $ingredients;
    private Cluster $cluster;
    private array $categories;
    private float $score;

    /**
     * Recipe constructor.
     */
    public function __construct(int $id, string $name, string $url_pic, string $summary, array $directions, int $prep_time,
                                int $cook_time, string $yield, int $serving, array $ingredients,
                                Cluster $cluster, array $categories, float $score = 0)
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
        $this->ingredients = $ingredients;
        $this->cluster = $cluster;
        $this->categories = $categories;
        $this->score = $score;
    }

    public function incrementScore(){
        $this->score = $this->score++;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getUrlPic():string
    {
        return $this->url_pic;
    }

    public function setUrlPic(string $url_pic)
    {
        $this->url_pic = $url_pic;
    }

    public function getSummary():string
    {
        return $this->summary;
    }

    public function setSummary(string $summary)
    {
        $this->summary = $summary;
    }

    public function getDirections():array
    {
        return $this->directions;
    }

    public function setDirections(array $directions)
    {
        $this->directions = $directions;
    }

    public function getPrepTime():int
    {
        return $this->prep_time;
    }

    public function setPrepTime(int $prep_time)
    {
        $this->prep_time = $prep_time;
    }

    public function getCookTime():int
    {
        return $this->cook_time;
    }

    public function setCookTime(int $cook_time)
    {
        $this->cook_time = $cook_time;
    }

    public function getYield():string
    {
        return $this->yield;
    }

    public function setYield(string $yield)
    {
        $this->yield = $yield;
    }

    public function getServing():int
    {
        return $this->serving;
    }

    public function setServing(int $serving)
    {
        $this->serving = $serving;
    }

    public function getIngredients():array
    {
        return $this->ingredients;
    }

    public function setIngredients(array $ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function getCluster():Cluster
    {
        return $this->cluster;
    }

    public function setCluster(Cluster $cluster)
    {
        $this->cluster = $cluster;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }


    public function getScore():float
    {
        return $this->score;
    }

    public function setScore(float $score)
    {
        $this->score = $score;
    }
}