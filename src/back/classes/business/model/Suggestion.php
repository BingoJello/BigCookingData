<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Suggestion
{
    private array $recipes;

    /**
     * Suggestion constructor.
     */
    public function __construct(array $recipes = array())
    {
        $this->recipes = $recipes;
    }

    public function addRecipes(Recipe $recipe)
    {
        array_push($this->recipes, $recipe);
    }

    public function deleteRecipe(int $id)
    {
        foreach ($this->recipes as $recipe)
        {
            if($recipe->getId() == $id)
            {
                array_splice($this->recipes, $id);
            }
        }
    }

    public function getRecipe(int $id):Recipe|null
    {
        foreach ($this->recipes as $recipe)
        {
            if($recipe->getId() == $id)
            {
                return $recipe;
            }
        }
        return null;
    }

    public function alreadyExist(int $id): bool
    {
        foreach ($this->recipes as $recipe)
        {
            if($recipe->getId() == $id)
            {
                return True;
            }
        }
        return False;
    }

    public function getRecipes():array
    {
        return $this->recipes;
    }

    public function setRecipes(array $recipes)
    {
        $this->recipes = $recipes;
    }
}