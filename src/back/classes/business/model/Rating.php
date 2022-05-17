<?php

/**
 * Class Rating
 * @author arthur mimouni
 */
class Rating
{
    /**
     * @var int
     */
    private $id_recipe;
    /**
     * @var float
     */
    private $score;

    /**
     * Rating constructor.
     * @param int $id_recipe
     * @param float $rating
     */
    public function __construct($id_recipe, $score){
        $this->id_recipe = $id_recipe;
        $this->score = $score;
   }

    /**
     * @return int
     */
    public function getIdRecipe()
    {
        return $this->id_recipe;
    }
    /**
     * @param int $score
     */
    public function setIdRecipe($id_recipe)
    {
        $this->id_recipe = $id_recipe;
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
    public function setscore($score)
    {
        $this->score = $score;
    }
}