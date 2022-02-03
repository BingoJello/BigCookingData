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
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

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
    private $assessedRecipes;

    /**
     * @var array
     */
    private $recordedRecipes;

    /**
     * @var array
     */
    private $preferencesCategories;

    /**
     * Client constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     * @param string $civility
     * @param string $pseudo
     * @param string $mail
     * @param string $password
     * @param string $diet
     * @param array $assessedRecipes
     * @param array $recordedRecipes
     * @param array $preferencesCategories
     */
    public function __construct($id, $firstName, $lastName, $civility, $pseudo, $mail, $password, $diet, array $assessedRecipes, array $recordedRecipes, array $preferencesCategories)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->civility = $civility;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->password = $password;
        $this->diet = $diet;
        $this->assessedRecipes = $assessedRecipes;
        $this->recordedRecipes = $recordedRecipes;
        $this->preferencesCategories = $preferencesCategories;
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
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
        return $this->assessedRecipes;
    }

    /**
     * @param array $assessedRecipes
     */
    public function setAssessedRecipes($assessedRecipes)
    {
        $this->assessedRecipes = $assessedRecipes;
    }

    /**
     * @return array
     */
    public function getRecordedRecipes()
    {
        return $this->recordedRecipes;
    }

    /**
     * @param array $recordedRecipes
     */
    public function setRecordedRecipes($recordedRecipes)
    {
        $this->recordedRecipes = $recordedRecipes;
    }

    /**
     * @return array
     */
    public function getPreferencesCategories()
    {
        return $this->preferencesCategories;
    }

    /**
     * @param array $preferencesCategories
     */
    public function setPreferencesCategories($preferencesCategories)
    {
        $this->preferencesCategories = $preferencesCategories;
    }
}