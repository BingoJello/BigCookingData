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
     * @var string
     */
    private $pseudo;
    /**
     * @var string
     */
    private $commentary;
    /**
     * @var string
     */
    private $date;

    /**
     * Rating constructor.
     * @param int $id_recipe
     * @param float $rating
     */
    public function __construct($id_recipe, $score = null, $pseudo = "", $commentary = "", $date = ""){
        $this->id_recipe = $id_recipe;
        $this->score = $score;
        $this->pseudo = $pseudo;
        $this->commentary = $commentary;
        $this->date = $date;
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

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * @param string $commentary
     */
    public function setCommentary($commentary): void
    {
        $this->commentary = $commentary;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }


}