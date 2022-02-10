<?php


class PairsItem
{
    private int $item1;
    private int $item2;
    private float $score;

    public function __construct(int $item1, int $item2)
    {
        $this->item1 = $item1;
        $this->item2 = $item2;
        $this->score = 0.0;
    }

    public function getItem1(): int
    {
        return $this->item1;
    }

    public function setItem1(int $item1): void
    {
        $this->item1 = $item1;
    }

    public function getItem2(): int
    {
        return $this->item2;
    }

    public function setItem2(int $item2): void
    {
        $this->item2 = $item2;
    }


    public function getScore(): float
    {
        return $this->score;
    }


    public function setScore(float $score): void
    {
        $this->score = $score;
    }

}