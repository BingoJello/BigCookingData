<?php


namespace classes\business\process;

use classes\business\manager\RecipeManager;

class ResearchBuilder implements RecipesBuilder
{
    private RecipeManager $recipeManager;
    private array $recipes;

    /**
     * SuggestionBuilder constructor.
     */
    public function __construct(RecipeManager $recipeManager)
    {
        $this->recipeManager = $recipeManager;
        $this->recipes = array();
    }

    public function buildRecipes(array $session)
    {
        // TODO: Implement buildRecipes() method.
    }

    public function getRecipes():array
    {
        return $this->recipes;
    }
}