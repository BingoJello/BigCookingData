<?php

class Ingredient
{
    private int $id;
    private string $name;
    private float $score;

    /**
     * Ingredient constructor.
     */
    public function __construct(int $id, string $name, float $score = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->score = $score;
    }

    public function incrementScore():void
    {
        $this->score = $this->score++;
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

    public function getScore():float
    {
        return $this->score;
    }

    public function setScore(float $score):void
    {
        $this->score = $score;
    }
}