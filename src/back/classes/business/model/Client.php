<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Client
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $civility;
    private string $pseudo;
    private string $mail;
    private string $password;
    private array $rated_recipes;
    private array $recorded_recipes;
    private array $preferences_ingredients;

    /**
     * Client constructor.
     */
    public function __construct(int $id, string $first_name = '', string $last_name = '', string $civility = '', string $pseudo = '',
                                string $mail = '', string $password = '', array $rated_recipes = array('recipes' => array(), 'ratings' => array()),
                                array $recorded_recipes = array(), array $preferences_ingredients = array())
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->civility = $civility;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->rated_recipes = $rated_recipes;
        $this->recorded_recipes = $recorded_recipes;
        $this->preferences_ingredients = $preferences_ingredients;
    }

    public function addRecordedRecipes(Recipe $recipe):void
    {
        array_push($this->recorded_recipes, $recipe);
    }

    public function addRatedRecipes(Recipe $recipe, float $rating):void
    {
        array_push($this->rated_recipes['recipes'], $recipe);
        array_push($this->rated_recipes['ratings'], $rating);
    }

    public function getRatingRecipe(int $id_recipe):float
    {
        foreach($this->rated_recipes as $recipe)
            if($recipe->getId() == $id_recipe)
                return $recipe->getScore();
        return 0;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name):void
    {
        $this->last_name = $last_name;
    }

    public function getCivility(): string
    {
        return $this->civility;
    }

    public function setCivility(string $civility):void
    {
        $this->civility = $civility;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo):void
    {
        $this->pseudo = $pseudo;
    }

    public function getMail(): string
    {
        return $this->mail;
    }

    public function setMail(string $mail):void
    {
        $this->mail = $mail;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password):void
    {
        $this->password = $password;
    }

    public function getRatedRecipes(): array
    {
        return $this->rated_recipes;
    }

    public function setRatedRecipes(array $rated_recipes):void
    {
        $this->rated_recipes = $rated_recipes;
    }

    public function getRecordedRecipes(): array
    {
        return $this->recorded_recipes;
    }

    public function setRecordedRecipes(array $recorded_recipes):void
    {
        $this->recorded_recipes = $recorded_recipes;
    }

    public function getPreferencesIngredients(): array
    {
        return $this->preferences_ingredients;
    }

    public function setPreferencesCategories(array $preferences_ingredients):void
    {
        $this->preferences_ingredients = $preferences_ingredients;
    }
}