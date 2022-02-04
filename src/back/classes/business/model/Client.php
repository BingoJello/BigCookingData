<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

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
     * @var string
     */
    private $diet;

    /**
     * @var array
     */
    private $assessed_recipes;

    /**
     * @var array
     */
    private $recorded_recipes;

    /**
     * @var array
     */
    private $preferences_categories;

    /**
     * Client constructor.
     * @param int $id
     * @param string $first_name
     * @param string $last_name
     * @param string $civility
     * @param string $pseudo
     * @param string $mail
     * @param string $password
     * @param string $diet
     * @param array $assessed_recipes
     * @param array $recorded_recipes
     * @param array $preferences_categories
     */
    public function __construct($id, $first_name, $last_name, $civility, $pseudo, $mail, $password, $diet, array $assessed_recipes, array $recorded_recipes, array $preferences_categories)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->civility = $civility;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->diet = $diet;
        $this->assessed_recipes = $assessed_recipes;
        $this->recorded_recipes = $recorded_recipes;
        $this->preferences_categories = $preferences_categories;
    }

    /**
     * @return int
     */
    public function getId()
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
     * @return string
     */
    public function getDiet()
    {
        return $this->diet;
    }

    /**
     * @param string $diet
     */
    public function setDiet($diet)
    {
        $this->diet = $diet;
    }

    /**
     * @return array
     */
    public function getAssessedRecipes()
    {
        return $this->assessed_recipes;
    }

    /**
     * @param array $assessed_recipes
     */
    public function setAssessedRecipes($assessed_recipes)
    {
        $this->assessed_recipes = $assessed_recipes;
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

    /**
     * @return array
     */
    public function getPreferencesCategories()
    {
        return $this->preferences_categories;
    }

    /**
     * @param array $preferences_categories
     */
    public function setPreferencesCategories($preferences_categories)
    {
        $this->preferences_categories = $preferences_categories;
    }
}