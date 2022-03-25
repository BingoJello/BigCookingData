<?php

/**
 * Class Assess
 * @author arthur mimouni
 */
class Assess
{
    /**
     * @var string
     */
    private $pseudo;
    /**
     * @var float
     */
    private $rating;
    /**
     * @var string
     */
    private $commentary;
    /**
     * @var string
     */
    private $date;

    /**
     * Assess constructor.
     * @param string $pseudo
     * @param float $rating
     * @param string $commentary
     * @param string $date
     */
    public function __construct($pseudo, $rating, $commentary='', $date){
        $this->pseudo = $pseudo;
        $this->rating = $rating;
        $this->commentary = $commentary;
        $this->date = $date;
   }

   /**
    * @return string
    */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    /**
    * @param string $pseudo
    */
    public function setPseudo($pseudo)
    {
        $this->$pseudo = $pseudo;
    }
    /**
    * @return float
    */
    public function getRating()
    {
        return $this->rating;
    }
    /**
    * @param float $rating
    */
    public function setRating($rating)
    {
        $this->rating = $rating;
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
    public function setCommentary($commentary)
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
    public function setDate($date)
    {
        $this->date = $date;
    }
}