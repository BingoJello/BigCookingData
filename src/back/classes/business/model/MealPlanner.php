<?php
/**
    Pour la suggestion des calories au client
*/

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class MeanPlanner extends Client{
    private int $nutrition;
    
    /**
    * MeanPlanner constructor.
    */
    public function __construct(int $id, string $first_name, string $last_name, string $civility, string $pseudo,
                                string $mail, string $password, array $assessed_recipes = array(),
                                array $recorded_recipes = array(), array $preferences_ingredients = array(), $nutrition)
    {
        super($id, $first_name, $last_name, $civility, $pseudo, $mail, $password, $assessed_recipes, $recorded_recipes, $preferences_ingredients);
        
        /**
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->civility = $civility;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->assessed_recipes = $assessed_recipes;
        $this->recorded_recipes = $recorded_recipes;
        $this->preferences_ingredients = $preferences_ingredients;
        */
        
        $this->nutrition = $nutrition;
    }
    
    public function getId(): int
    {
        // return $this->id;
        return super.getId();
    }

    public function setId(int $id)
    {
        // $this->id = $id;
        super.setId($id);
    }

    public function getFirstName(): string
    {
        // return $this->first_name;
        return super.getFirstName();
    }

    public function setFirstName(string $first_name)
    {
        // $this->first_name = $first_name;
        super.setFirstName($first_name);
    }

    public function getLastName(): string
    {
        // return $this->last_name;
        return super.getLastName();
    }

    public function setLastName(string $last_name)
    {
        // $this->last_name = $last_name;
        super.setLastName($last_name);
    }

    public function getCivility(): string
    {
        // return $this->civility;
        return super.getCivility();
    }

    public function setCivility(string $civility)
    {
        // $this->civility = $civility;
        super.setCivility($civility);
    }

    public function getPseudo(): string
    {
        // return $this->pseudo;
        return super.getPseudo();
    }

    public function setPseudo(string $pseudo)
    {
        // $this->pseudo = $pseudo;
        super.setPseudo($pseudo);
    }

    public function getMail(): string
    {
        // return $this->mail;
        return super.getMail();
    }

    public function setMail(string $mail)
    {
        // $this->mail = $mail;
        super.setMail($mail);
    }

    public function getPassword(): string
    {
        // return $this->password;
        return super.getPassword();
    }

    public function setPassword(string $password)
    {
        // $this->password = $password;
        super.setPassword($password);
    }

    public function getAssessedRecipes(): array
    {
        // return $this->assessed_recipes;
        return super.getAssessedRecipes();
    }

    public function setAssessedRecipes(array $assessed_recipes)
    {
        // $this->assessed_recipes = $assessed_recipes;
        super.setAssessedRecipes = $assessed_recipes;
    }

    public function getRecordedRecipes(): array
    {
        // return $this->recorded_recipes;
        return super.getRecordedRecipes();
    }

    public function setRecordedRecipes(array $recorded_recipes)
    {
        // $this->recorded_recipes = $recorded_recipes;
        super.setRecordedRecipes($recorded_recipes);
    }

    public function getPreferencesIngredients(): array
    {
        // return $this->preferences_ingredients;
        return super.getPreferencesIngredients();
    }

    public function setPreferencesCategories(array $preferences_ingredients)
    {
        // $this->preferences_ingredients = $preferences_ingredients;
        super.setPreferencesCategories($preferences_ingredients);
    }
}
