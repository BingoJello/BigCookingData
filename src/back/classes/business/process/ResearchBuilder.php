<?php


namespace classes\business\process;


use classes\business\manager\RecipeManager;

class ResearchBuilder implements RecipesBuilder
{
    /**
     * @var RecipeManager
     */
    private $recipeManager;

    /**
     * @var array
     */
    private $recipes;

    /**
     * SuggestionBuilder constructor.
     * @param RecipeManager $recipeManager
     */
    public function __construct(RecipeManager $recipeManager)
    {
        $this->recipeManager = $recipeManager;
        $this->recipes = array();
    }

    public function buildRecipes()
    {
        // TODO: Implement buildRecipes() method.
    }

    /**
     * @return array
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
}