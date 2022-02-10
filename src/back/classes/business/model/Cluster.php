<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Cluster
{
    private int $id;
    private float $score;

    /**
     * Cluster constructor.
     */
    public function __construct(int $id, float $score = 0)
    {
        $this->id = $id;
        $this->score = $score;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function setScore(float $score):void
    {
        $this->score = $score;
    }

}