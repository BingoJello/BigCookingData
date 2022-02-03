<?php

namespace classes\business\model;

use classes\AutoLoader;
AutoLoader::register();

class Suggestion
{
    /**
     * @var array
     */
    private $recipes;

    /**
     * Suggestion constructor.
     * @param array $recipes
     */
    public function __construct($recipes = array())
    {
        $this->recipes = $recipes;
    }

    public function addRecipes($recipe){
        array_push($this->recipes, $recipe);
    }

    public function deleteRecipe($id){
        foreach ($this->recipes as $key => $recipe){
            if($recipe->getId() == $id){
                array_splice($this->recipes, $id);
            }
        }
        return null;
    }

    public function getRecipe($id){
        foreach ($this->recipes as $key => $recipe){
            if($recipe->getId() == $id){
                return $recipe;
            }
        }
        return null;
    }

    public function alreadyExist($id){
        foreach ($this->recipes as $key => $recipe){
            if($recipe->getId() == $id){
                return True;
            }
        }
        return False;
    }

    /**
    * @return array
    */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
    * @param array $recipes
    */
    public function setRecipes($recipes)
    {
        $this->recipes = $recipes;
    }
}