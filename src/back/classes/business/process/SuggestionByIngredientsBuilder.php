<?php


class SuggestionByIngredientsBuilder implements RecipesBuilder
{
    private array $ingredients_include = array();
    private array $ingredients_exclude = array();
    private array $recipes = array();

    /**
     * SuggestionByIngredientsBuilder constructor.
     * @throws Exception
     */
    public function __construct(array $ingredients_include, array $ingredients_exclude)
    {
        $this->ingredients_include = $ingredients_include;
        $this->ingredients_exclude = $ingredients_exclude;
    }

    public function buildRecipes($session=null):void
    {
        $best_cluster = DecisionTreeCluster::getCluster($this->ingredients_include);
        $recipes_ingredients = RecipePersistence::getRecipesByIngredientsAndCluster($best_cluster, $this->ingredients_include,
            $this->ingredients_exclude);

    }

    public function getRecipes(): array
    {
        return $this->recipes;
    }
}