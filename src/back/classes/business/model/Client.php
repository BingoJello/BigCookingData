<?php

/**
 * Class Client
 * @author arthur mimouni
 */
class Client
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $first_name;
    /**
     * @var string
     */
    private $last_name;
    /**
     * @var string
     */
    private $civility;
    /**
     * @var string
     */
    private $pseudo;
    /**
     * @var string
     */
    private $mail;
    /**
     * @var string
     */
    private $password;
    /**
     * @var array
     */
    private $preferences_ingredients;
    /**
     * @var array|array[]
     */
    private $rated_recipes;
    /**
     * @var array
     */
    private $recorded_recipes;

    /**
     * Client constructor.
     * @param int $id
     * @param string $first_name
     * @param string $last_name
     * @param string $civility
     * @param string $pseudo
     * @param string $mail
     * @param string $password
     * @param array $preferences_ingredients
     * @param array $rated_recipes
     * @param array $recorded_recipes
     */
    public function __construct($id, $first_name = '', $last_name = '', $civility = '', $pseudo = '',
                                $mail = '', $password = '', $preferences_ingredients = array(),
                                $rated_recipes = array(), array $recorded_recipes = array())
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->civility = $civility;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->preferences_ingredients = $preferences_ingredients;
        $this->rated_recipes = $rated_recipes;
        $this->recorded_recipes = $recorded_recipes;
    }

    /**
     * @param Recipe $recipe
     * @return void
     */
    public function addRecordedRecipes($recipe)
    {
        array_push($this->recorded_recipes, $recipe);
    }

    /**
     * @param object $recipe
     * @param float $rating
     * @return void
     */
    public function addRatedRecipes($recipe, $rating)
    {
        array_push($this->rated_recipes['recipes'], $recipe);
        array_push($this->rated_recipes['ratings'], $rating);
    }

    /**
     * @param int $id_recipe
     * @return float
     */
    public function getRatingRecipe($id_recipe):float
    {
        foreach($this->rated_recipes as $recipe)
            if($recipe->getId() == $id_recipe)
                return $recipe->getScore();
        return 0;
    }

    /**
     * @return int
     */
    public function getId(): int
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
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param string $civility
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;
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
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return array
     */
    public function getPreferencesIngredients()
    {
        return $this->preferences_ingredients;
    }

    /**
     * @param array $preferences_ingredients
     */
    public function setPreferencesIngredients($preferences_ingredients)
    {
        $this->preferences_ingredients = $preferences_ingredients;
    }

    /**
     * @return array|array[]
     */
    public function getRatedRecipes()
    {
        return $this->rated_recipes;
    }

    /**
     * @param array|array[] $rated_recipes
     */
    public function setRatedRecipes($rated_recipes)
    {
        $this->rated_recipes = $rated_recipes;
    }

    /**
     * @return array
     */
    public function getRecordedRecipes()
    {
        return $this->recorded_recipes;
    }

    /**
     * @param array $recorded_recipes
     */
    public function setRecordedRecipes($recorded_recipes)
    {
        $this->recorded_recipes = $recorded_recipes;
    }
}