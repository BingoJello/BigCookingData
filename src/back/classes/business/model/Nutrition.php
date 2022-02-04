<?php

namespace classes\business\model;

use classes\AutoLoader;

AutoLoader::register();

class Nutrition
{
    /**
     * @var string
     */
    private $calories;

    /**
     * @var string
     */
    private $carbohydrates;

    /**
     * @var string
     */
    private $sugars;

    /**
     * @var string
     */
    private $saturated_fat;

    /**
     * @var string
     */
    private $fat;

    /**
     * @var string
     */
    private $cholesterol;

    /**
     * @var string
     */
    private $protein;

    /**
     * Nutrition constructor.
     * @param string $calories
     * @param string $carbohydrates
     * @param string $sugars
     * @param string $saturated_fat
     * @param string $fat
     * @param string $cholesterol
     * @param string $protein
     */
    public function __construct($calories, $carbohydrates, $sugars, $saturated_fat, $fat, $cholesterol, $protein)
    {
        $this->calories = $calories;
        $this->carbohydrates = $carbohydrates;
        $this->sugars = $sugars;
        $this->saturated_fat = $saturated_fat;
        $this->fat = $fat;
        $this->cholesterol = $cholesterol;
        $this->protein = $protein;
    }

    /**
     * @return string
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * @param string $calories
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;
    }

    /**
     * @return string
     */
    public function getCarbohydrates()
    {
        return $this->carbohydrates;
    }

    /**
     * @param string $carbohydrates
     */
    public function setCarbohydrates($carbohydrates)
    {
        $this->carbohydrates = $carbohydrates;
    }

    /**
     * @return string
     */
    public function getSugars()
    {
        return $this->sugars;
    }

    /**
     * @param string $sugars
     */
    public function setSugars($sugars)
    {
        $this->sugars = $sugars;
    }

    /**
     * @return string
     */
    public function getSaturatedFat()
    {
        return $this->saturated_fat;
    }

    /**
     * @param string $saturated_fat
     */
    public function setSaturatedFat($saturated_fat)
    {
        $this->saturated_fat = $saturated_fat;
    }

    /**
     * @return string
     */
    public function getFat()
    {
        return $this->fat;
    }

    /**
     * @param string $fat
     */
    public function setFat($fat)
    {
        $this->fat = $fat;
    }

    /**
     * @return string
     */
    public function getCholesterol()
    {
        return $this->cholesterol;
    }

    /**
     * @param string $cholesterol
     */
    public function setCholesterol($cholesterol)
    {
        $this->cholesterol = $cholesterol;
    }

    /**
     * @return string
     */
    public function getProtein()
    {
        return $this->protein;
    }

    /**
     * @param string $protein
     */
    public function setProtein($protein)
    {
        $this->protein = $protein;
    }
}